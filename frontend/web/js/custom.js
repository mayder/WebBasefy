function aplicarMascaras() {
    if ($.fn.inputmask) {
        $('.cnpj').inputmask('99.999.999/9999-99');
        $('.cpf').inputmask('999.999.999-99');
        $('.moeda').inputmask('currency', {
            prefix: 'R$ ',
            groupSeparator: '.',
            radixPoint: ',',
            digits: 2,
            autoGroup: true,
            rightAlign: false,
            removeMaskOnSubmit: true
        });
    }
}

$(document).ready(function () {
    aplicarMascaras();
});

$(document).on('ajaxComplete', function (event, xhr, settings) {
    aplicarMascaras();

    if (xhr.responseJSON && xhr.responseJSON.message) {
        const msg = xhr.responseJSON.message;

        // Cria o container se não existir
        let container = document.getElementById('toast-container');
        if (!container) {
            container = document.createElement('div');
            container.id = 'toast-container';
            container.className = 'toast-container position-fixed top-0 end-0 p-3';
            container.style.zIndex = 1100;
            document.body.appendChild(container);
        }

        // Cria o toast
        const toast = document.createElement('div');
        toast.className = 'toast align-items-center text-white border-0 show';
        toast.setAttribute('role', 'alert');
        toast.setAttribute('aria-live', 'assertive');
        toast.setAttribute('aria-atomic', 'true');
        toast.dataset.bsDelay = '4000';

        switch (msg.type) {
            case 'success':
                toast.classList.add('bg-success');
                break;
            case 'error':
                toast.classList.add('bg-danger');
                break;
            case 'warning':
                toast.classList.add('bg-warning', 'text-dark');
                break;
            default:
                toast.classList.add('bg-primary');
        }

        toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">${msg.text}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Fechar"></button>
            </div>
        `;

        container.appendChild(toast);
        new bootstrap.Toast(toast).show();
    }
});

$(document).on('pjax:end', function () {
    // console.log('pjax:end');
});
