$(() => {
    (new App).init();
    (new Modals()).init();
    (new Notification()).init();
    (new StatisticsPage()).init();
    (new AdminsPage()).init();
    (new InstructionsPage()).init();
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
        this.customOnChangeModal();
        this.deleteImageModal();
    }

    confirmationDialogModal(data, submit, cancel) {
        new duDialog(data.dialogTitle, data.dialogText, duDialog.OK_CANCEL, {
            okText: data.dialogOkText,
            cancelText: data.dialogCancelText,
            callbacks: {
                okClick: function () {
                    this.hide();
                    submit();
                },
                cancelClick: function () {
                    this.hide();
                    cancel();
                },
            }
        });
    }

    customOnChangeModal() {
        const _this = this;
        let oldValue;
        $('body').on('focus', '.custom-onchange-form', function (e) {
            oldValue = $(this).val();
        });

        $('body').on('change', '.custom-onchange-form', function (e) {
            e.preventDefault();
            const $this = $(this);
            const data = $this.data();

            _this.confirmationDialogModal(data, () => {
                $this.closest('form').submit();
            }, () => {
                $this.val(oldValue);
            })
        })
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
            const $this = $(this);
            const data = $this.data();

            _this.confirmationDialogModal(data, () => {
                $.ajax({
                    url: data.url,
                    method: 'delete',
                    success: function (response) {
                        console.log(response)
                        $this.closest('.row').find(`input[name=${data.fieldName}]`).val('');
                        $this.closest('.row').find('img').prop('src', '');
                    }
                });
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

// Statistics page class.
class StatisticsPage {
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

// Admins page class.
class AdminsPage {
    constructor() {
        this.ROLE_SUPER_ADMIN = 1;
        this.ROLE_ADMIN       = 2;
        this.ROLE_SELLER      = 3;
    }

    init() {
        $('select#role_id').on('change', this.togglePermissionsCheckboxes);
        $(document).ready(this.togglePermissionsCheckboxes);
    }

    togglePermissionsCheckboxes() {
        if ($('select#role_id option:selected').val() == this.ROLE_SELLER) {
            $('#can_edit_admin').prop('checked', false).parent().hide();
            $('#can_delete_admin').prop('checked', false).parent().hide();
        } else {
            $('#can_edit_admin').parent().show();
            $('#can_delete_admin').parent().show();
        }
    }
}

// Instructions page class.
class InstructionsPage {
    init() {
        this.submitExternalForm();
    }

    submitExternalForm() {
        $('.external-submit-form').on('click', function () {
            const form = $(this).closest('form');
            const data = $(this).data();

            if (form.find('input[name="_method"]').length) {
                form.find('input[name="_method"]').val(data.method);
            } else {
                form.append('<input type="hidden" name="_method" value="' + data.method + '"/>');
            }

            form
                .attr('action', data.url)
                .attr('method', 'POST')
                .submit();
        });
    }
}
