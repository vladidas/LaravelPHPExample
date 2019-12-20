$(() => {
    (new App).init();
    (new Modals()).init();
    (new Notification()).init();
    (new Statistics()).init();
});

// Application class.
class App {
    init() {
        this.setHeaderToAjax();
        this.hidePreloader();
        this.logout();
        this.previewImage();
        this.initSelect2();
        this.initDatePicker();
        this.initCountTo();
        this.autoSubmitOnChange();
        this.disableAutocomlete();
    }

    setHeaderToAjax() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': _csrf,
            }
        });
    }

    hidePreloader() {
        setTimeout(() => {
            $('.page-loader-wrapper').fadeOut();
        }, 50);
    }

    logout() {
        $('body').on('click', '#logout-btn', () => {
            $('#logout-form').submit();
        })
    }

    previewImage() {
        $('body').on('change', 'input:file', function () {
            const input = this;

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    $(input).closest('.fileinput').find('img').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        })
    }

    initSelect2() {
        $('.select-two').select2({
            width: '100%',
            language: {
                noResults: () => {}
            },
        });
    }

    initDatePicker() {
        $('.datetimepicker').datepicker({
            format: 'yyyy-mm-dd',
        }).on('change', function () {
            $('.datepicker').hide();
        });
    }

    initCountTo() {
        if($('.count-to').length) {
            $('.count-to').countTo();
        }
    }

    autoSubmitOnChange() {
        $('.submit-onchange').on('change', function () {
            $(this).parent().submit();
        })
    }

    disableAutocomlete() {
        $('input').prop('autocomplete', 'off');
    }
}

// Modals class.
class Modals {
    init() {
        this.customDeleteModal();
        this.deleteImageModal();
    }

    confirmationDialogModal(data, submit) {
        new duDialog(data.dialogTitle, data.dialogText, duDialog.OK_CANCEL, {
            okText: data.dialogOkText,
            cancelText: data.dialogCancelText,
            callbacks: {
                okClick: function () {
                    this.hide();
                    submit();
                },
            }
        });
    }

    customDeleteModal() {
        const _this = this;
        $('body').on('click', '.custom-delete-form', function (e) {
            e.preventDefault();
            const data = $(this).data();

            _this.confirmationDialogModal(data, () => {
                $(this).closest('form').submit();
            })
        })
    }

    deleteImageModal(data, submit) {
        const _this = this;
        $('body').on('click', '.delete-image-button', function (e) {
            e.preventDefault();
            const data = $(this).data();

            _this.confirmationDialogModal(data, () => {
                $(this).closest('.row').find(`input[name=${data.fieldName}]`).val('');
                $(this).closest('.row').find('img').prop('src', '');
            })
        })
    }
}

// Notification class.
class Notification {
    init() {
        this.notifyInit();
    }

    notifyInit() {
        if (ntfSuccess) return $.notify(ntfSuccess, 'success');
        if (ntfDanger)  return $.notify(ntfDanger, 'danger');
        if (ntfInfo)    return $.notify(ntfInfo, 'info');
        if (ntfWarning) return $.notify(ntfWarning, 'warning');
    }
}

// Statistics class.
class Statistics {
    init() {
        this.changeUrlInForm();
    }

    changeUrlInForm() {
        $('.outlets-statistics-form').on('change', function () {
            const url = $(this).val()
            $(this).closest('form').prop('action', url);
        });
    }
}
