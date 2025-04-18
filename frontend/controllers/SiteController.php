<?php

namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'except' => ['login', 'signup', 'resend-verification-email', 'request-password-reset', 'error'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Cadastro realizado com sucesso! Verifique seu e-mail para ativar sua conta.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Enviamos instruções para redefinição de senha no seu e-mail.');
                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Não foi possível enviar as instruções para o e-mail informado.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new \yii\web\BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Sua nova senha foi salva com sucesso!');
            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        $usuario = \common\models\Usuario::findOne(['token_verificacao_email' => $token]);

        if (!$usuario) {
            Yii::$app->session->setFlash('error', 'Token inválido ou expirado.');
            return $this->redirect(['site/login']);
        }

        $usuario->status = true;
        $usuario->token_verificacao_email = null;
        $usuario->save(false);

        Yii::$app->user->login($usuario); // opcional

        Yii::$app->session->setFlash('success', 'E-mail confirmado com sucesso!');
        return $this->redirect(['site/index']);
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new \frontend\models\ResendVerificationEmailForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $usuario = \common\models\Usuario::findOne([
                'email' => $model->email,
                'status' => false, // apenas se ainda não estiver verificado
            ]);

            if ($usuario) {
                // Gera novo token, se necessário
                $usuario->token_verificacao_email = Yii::$app->security->generateRandomString() . '_' . time();

                if ($usuario->save(false)) {
                    if ($model->sendEmail($usuario)) {
                        Yii::$app->session->setFlash('success', 'Verificação reenviada com sucesso. Verifique seu e-mail.');
                        return $this->goHome();
                    }
                }
            }

            Yii::$app->session->setFlash('error', 'Não foi possível reenviar o e-mail de verificação. Verifique se o e-mail está correto ou já foi confirmado.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model,
        ]);
    }
}
