@extends('layouts.admin')

@section('title', 'Accounts')
@push('styles')
<style>
/* Accounts Page Styles */
.accounts-container {
    max-width: 100%;
}

.accounts-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
}

.accounts-title {
    font-size: 20px;
    font-weight: 600;
    color: var(--text-dark);
}

/* Buttons */
.btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s;
}

.btn-primary {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
    color: #fff;
    box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(79, 70, 229, 0.4);
}

.btn-primary:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
}

.btn-secondary {
    background: #e2e8f0;
    color: var(--text-dark);
}

.btn-secondary:hover {
    background: #cbd5e1;
}

.btn-sm {
    padding: 6px 12px;
    font-size: 13px;
}

.btn-edit {
    background: #3b82f6;
    color: #fff;
}

.btn-edit:hover {
    background: #2563eb;
}

.btn-delete {
    background: #ef4444;
    color: #fff;
}

.btn-delete:hover {
    background: #dc2626;
}

/* Table Styles */
.table-container {
    background: var(--bg-white);
    border-radius: 12px;
    box-shadow: var(--shadow);
    overflow-x: auto;
}

.accounts-table {
    width: 100%;
    border-collapse: collapse;
}

.accounts-table th,
.accounts-table td {
    padding: 14px 16px;
    text-align: left;
    border-bottom: 1px solid var(--border);
}

.accounts-table th {
    background: #f8fafc;
    font-weight: 600;
    font-size: 13px;
    color: var(--text-gray);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.accounts-table tbody tr:hover {
    background: #f8fafc;
}

.accounts-table tbody tr:last-child td {
    border-bottom: none;
}

.text-center {
    text-align: center;
}

.text-muted {
    color: var(--text-light);
    font-size: 14px;
}

.text-danger {
    color: #ef4444;
}

/* Actions Cell */
.actions-cell {
    display: flex;
    gap: 8px;
    align-items: center;
}

/* Empty State */
.empty-state {
    padding: 60px 20px !important;
    color: var(--text-light);
}

.empty-state i {
    font-size: 48px;
    margin-bottom: 16px;
    color: #cbd5e1;
}

.empty-state p {
    margin: 0;
    font-size: 15px;
}

/* Loading State */
.loading-state {
    padding: 40px 20px !important;
    text-align: center;
    color: var(--text-light);
}

.loading-state i {
    font-size: 32px;
    margin-bottom: 12px;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

/* Toast Container */
#toastContainer {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

/* Toast Styles */
.toast {
    padding: 14px 20px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    gap: 10px;
    min-width: 300px;
    max-width: 400px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    animation: toastSlideIn 0.3s ease;
}

@keyframes toastSlideIn {
    from {
        opacity: 0;
        transform: translateX(100%);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes toastSlideOut {
    from {
        opacity: 1;
        transform: translateX(0);
    }
    to {
        opacity: 0;
        transform: translateX(100%);
    }
}

.toast-success {
    background: #d1fae5;
    color: #065f46;
    border: 1px solid #a7f3d0;
}

.toast-danger {
    background: #fee2e2;
    color: #991b1b;
    border: 1px solid #fecaca;
}

.toast .close-toast {
    margin-left: auto;
    background: none;
    border: none;
    font-size: 18px;
    cursor: pointer;
    opacity: 0.6;
    transition: opacity 0.2s;
}

.toast .close-toast:hover {
    opacity: 1;
}

/* Modal Styles */
.modal-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(4px);
    z-index: 1000;
    justify-content: center;
    align-items: center;
    padding: 20px;
}

.modal-overlay.show {
    display: flex;
}

.modal {
    background: var(--bg-white);
    border-radius: 16px;
    width: 100%;
    max-width: 500px;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
    animation: modalSlideIn 0.3s ease;
}

.modal-sm {
    max-width: 400px;
}

@keyframes modalSlideIn {
    from {
        opacity: 0;
        transform: translateY(-30px) scale(0.95);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 24px;
    border-bottom: 1px solid var(--border);
}

.modal-header h3 {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 18px;
    font-weight: 600;
    color: var(--text-dark);
}

.modal-header h3 i {
    color: var(--primary);
}

.modal-header h3 i.text-danger {
    color: #ef4444;
}

.modal-close {
    background: none;
    border: none;
    font-size: 24px;
    color: var(--text-light);
    cursor: pointer;
    padding: 0;
    line-height: 1;
    transition: color 0.2s;
}

.modal-close:hover {
    color: var(--danger);
}

.modal-body {
    padding: 24px;
}

.modal-footer {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    padding: 16px 24px;
    border-top: 1px solid var(--border);
    background: #f8fafc;
    border-radius: 0 0 16px 16px;
}

/* Form Styles */
.form-group {
    display: flex;
    flex-direction: column;
    margin-bottom: 16px;
}

.form-group:last-child {
    margin-bottom: 0;
}

.form-group label {
    font-size: 14px;
    font-weight: 500;
    color: var(--text-dark);
    margin-bottom: 6px;
}

.form-group label .required {
    color: var(--danger);
}

.form-control {
    padding: 10px 14px;
    border: 1px solid var(--border);
    border-radius: 8px;
    font-size: 14px;
    color: var(--text-dark);
    transition: all 0.2s;
}

.form-control:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
}

.form-control::placeholder {
    color: var(--text-light);
}

.form-control.is-invalid {
    border-color: #ef4444;
}

.invalid-feedback {
    color: #ef4444;
    font-size: 12px;
    margin-top: 4px;
}

/* Responsive */
@media (max-width: 768px) {
    .accounts-header {
        flex-direction: column;
        gap: 16px;
        align-items: stretch;
    }
    
    .actions-cell {
        flex-direction: column;
        gap: 4px;
    }
    
    .btn-sm {
        width: 100%;
        justify-content: center;
    }
}
</style>
@endpush

@section('content')
<!-- Toast Container -->
<div id="toastContainer"></div>

<div class="accounts-container">
    <!-- Header with Add Button on Right -->
    <div class="accounts-header">
        <h2 class="accounts-title">Manage Accounts</h2>
        <button class="btn btn-primary" id="btnAddAccount">
            <i class="fas fa-plus"></i> Add New Account
        </button>
    </div>

    <!-- Accounts Table -->
    <div class="table-container">
        <table class="accounts-table" id="accountsTable">
            <thead>
                <tr>
                    <th style="width: 60px;">#</th>
                    <th style="width: 35%;">Title</th>
                    <th style="width: 25%;">Owner</th>
                    <th style="width: 20%;">Contact</th>
                    <th style="width: 150px;">Actions</th>
                </tr>
            </thead>
            <tbody id="accountsTableBody">
                <!-- Data will be loaded via jQuery -->
            </tbody>
        </table>
    </div>
</div>

<!-- Add Account Modal -->
<div class="modal-overlay" id="addAccountModal">
    <div class="modal">
        <div class="modal-header">
            <h3><i class="fas fa-user-plus"></i> Add New Account</h3>
            <button class="modal-close" onclick="closeModal('addAccountModal')">&times;</button>
        </div>
        <form id="addAccountForm">
            <div class="modal-body">
                <div class="form-group">
                    <label for="ac_title">Title <span class="required">*</span></label>
                    <input type="text" id="ac_title" name="ac_title" class="form-control" required placeholder="Enter account title">
                </div>
                <div class="form-group">
                    <label for="ac_owner">Owner <span class="required">*</span></label>
                    <input type="text" id="ac_owner" name="ac_owner" class="form-control" required placeholder="Enter owner name" maxlength="45">
                </div>
                <div class="form-group">
                    <label for="ac_contact">Contact <span class="required">*</span></label>
                    <input type="text" id="ac_contact" name="ac_contact" class="form-control" required placeholder="Enter contact number" maxlength="45">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('addAccountModal')">Cancel</button>
                <button type="submit" class="btn btn-primary" id="btnSubmitAdd">
                    <i class="fas fa-save"></i> Create Account
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Account Modal -->
<div class="modal-overlay" id="editAccountModal">
    <div class="modal">
        <div class="modal-header">
            <h3><i class="fas fa-edit"></i> Edit Account</h3>
            <button class="modal-close" onclick="closeModal('editAccountModal')">&times;</button>
        </div>
        <form id="editAccountForm">
            <input type="hidden" id="edit_id" name="id">
            <div class="modal-body">
                <div class="form-group">
                    <label for="edit_ac_title">Title <span class="required">*</span></label>
                    <input type="text" id="edit_ac_title" name="ac_title" class="form-control" required placeholder="Enter account title">
                </div>
                <div class="form-group">
                    <label for="edit_ac_owner">Owner <span class="required">*</span></label>
                    <input type="text" id="edit_ac_owner" name="ac_owner" class="form-control" required placeholder="Enter owner name" maxlength="45">
                </div>
                <div class="form-group">
                    <label for="edit_ac_contact">Contact <span class="required">*</span></label>
                    <input type="text" id="edit_ac_contact" name="ac_contact" class="form-control" required placeholder="Enter contact number" maxlength="45">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('editAccountModal')">Cancel</button>
                <button type="submit" class="btn btn-primary" id="btnSubmitEdit">
                    <i class="fas fa-save"></i> Update Account
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal-overlay" id="deleteAccountModal">
    <div class="modal modal-sm">
        <div class="modal-header">
            <h3><i class="fas fa-exclamation-triangle text-danger"></i> Confirm Delete</h3>
            <button class="modal-close" onclick="closeModal('deleteAccountModal')">&times;</button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="delete_id">
            <p class="text-center">Are you sure you want to delete this account?</p>
            <p class="text-center text-muted" id="deleteAccountName"></p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeModal('deleteAccountModal')">Cancel</button>
            <button type="button" class="btn btn-delete" id="btnConfirmDelete">
                <i class="fas fa-trash"></i> Delete
            </button>
        </div>
    </div>
</div>
@endsection



@push('scripts')
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- Modal Functions Script -->
<script>
// Modal Functions
function openModal(modalId) {
    $('#' + modalId).addClass('show');
    $('body').css('overflow', 'hidden');
}

function closeModal(modalId) {
    $('#' + modalId).removeClass('show');
    $('body').css('overflow', 'auto');
}

// Close modal on overlay click
$(document).on('click', '.modal-overlay', function(e) {
    if (e.target === this) {
        $(this).removeClass('show');
        $('body').css('overflow', 'auto');
    }
});

// Close modal on Escape key
$(document).on('keydown', function(e) {
    if (e.key === 'Escape') {
        $('.modal-overlay.show').removeClass('show');
        $('body').css('overflow', 'auto');
    }
});
</script>

<!-- Toast Functions Script -->
<script>
// Show Toast Message
function showAlert(type, message) {
    var icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';
    var toastId = 'toast-' + Date.now();
    var toastHtml = `
        <div class="toast toast-${type}" id="${toastId}">
            <i class="fas ${icon}"></i>
            <span>${message}</span>
            <button class="close-toast" onclick="closeToast('${toastId}')">&times;</button>
        </div>
    `;
    $('#toastContainer').append(toastHtml);
    
    // Auto hide after 4 seconds
    setTimeout(function() {
        closeToast(toastId);
    }, 4000);
}

// Close Toast
function closeToast(toastId) {
    var $toast = $('#' + toastId);
    $toast.css('animation', 'toastSlideOut 0.3s ease forwards');
    setTimeout(function() {
        $toast.remove();
    }, 300);
}
</script>

<!-- Retrieve Accounts Script (GET) -->
<script>
// Load accounts from server
function loadAccounts() {
    $('#accountsTableBody').html(`
        <tr>
            <td colspan="5" class="loading-state">
                <i class="fas fa-spinner"></i>
                <p>Loading accounts...</p>
            </td>
        </tr>
    `);

    $.ajax({
        url: '{{ route("accounts.index") }}',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success && response.data.length > 0) {
                renderAccountsTable(response.data);
            } else {
                $('#accountsTableBody').html(`
                    <tr>
                        <td colspan="5" class="text-center empty-state">
                            <i class="fas fa-folder-open"></i>
                            <p>No accounts found. Click "Add New Account" to create one.</p>
                        </td>
                    </tr>
                `);
            }
        },
        error: function(xhr) {
            $('#accountsTableBody').html(`
                <tr>
                    <td colspan="5" class="text-center empty-state">
                        <i class="fas fa-exclamation-triangle text-danger"></i>
                        <p>Error loading accounts. Please refresh the page.</p>
                    </td>
                </tr>
            `);
        }
    });
}

// Render accounts table
function renderAccountsTable(accounts) {
    var html = '';
    $.each(accounts, function(index, account) {
        html += `
            <tr data-id="${account.ac_id}">
                <td>${index + 1}</td>
                <td>${escapeHtml(account.ac_title)}</td>
                <td>${escapeHtml(account.ac_owner)}</td>
                <td>${escapeHtml(account.ac_contact)}</td>
                <td class="actions-cell">
                    <button class="btn btn-sm btn-edit" onclick='openEditAccountModal(${JSON.stringify(account)})'>
                        <i class="fas fa-edit"></i> 
                    </button>
                    <button class="btn btn-sm btn-delete" onclick="openDeleteModal(${account.ac_id}, '${escapeHtml(account.ac_title)}')">
                        <i class="fas fa-trash"></i> 
                    </button>
                </td>
            </tr>
        `;
    });
    $('#accountsTableBody').html(html);
}

// Helper functions
function escapeHtml(text) {
    if (!text) return '';
    var div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// Load accounts on page load
$(document).ready(function() {
    loadAccounts();
});
</script>

<!-- Submit Account Script (CREATE) -->
<script>
// Open Add Modal
$('#btnAddAccount').on('click', function() {
    // Reset form
    $('#addAccountForm')[0].reset();
    $('#addAccountForm .is-invalid').removeClass('is-invalid');
    $('#addAccountForm .invalid-feedback').remove();
    openModal('addAccountModal');
});

// Handle Add Account Form Submit
$('#addAccountForm').on('submit', function(e) {
    e.preventDefault();
    
    var $btn = $('#btnSubmitAdd');
    var originalText = $btn.html();
    
    // Disable button and show loading
    $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Creating...');
    
    // Clear previous errors
    $(this).find('.is-invalid').removeClass('is-invalid');
    $(this).find('.invalid-feedback').remove();
    
    $.ajax({
        url: '{{ route("accounts.store") }}',
        type: 'POST',
        data: $(this).serialize(),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.success) {
                closeModal('addAccountModal');
                showAlert('success', response.message);
                loadAccounts(); // Refresh table
                $('#addAccountForm')[0].reset();
            }
        },
        error: function(xhr) {
            if (xhr.status === 422) {
                // Validation errors
                var errors = xhr.responseJSON.errors;
                $.each(errors, function(field, messages) {
                    var $input = $('#' + field);
                    $input.addClass('is-invalid');
                    $input.after('<div class="invalid-feedback">' + messages[0] + '</div>');
                });
            } else {
                showAlert('danger', 'An error occurred. Please try again.');
            }
        },
        complete: function() {
            $btn.prop('disabled', false).html(originalText);
        }
    });
});
</script>

<!-- Edit Account Script (UPDATE) -->
<script>
// Open Edit Modal with account data
function openEditAccountModal(account) {
    // Reset form
    $('#editAccountForm .is-invalid').removeClass('is-invalid');
    $('#editAccountForm .invalid-feedback').remove();
    
    // Populate form fields
    $('#edit_id').val(account.ac_id);
    $('#edit_ac_title').val(account.ac_title);
    $('#edit_ac_owner').val(account.ac_owner);
    $('#edit_ac_contact').val(account.ac_contact);
    
    openModal('editAccountModal');
}

// Handle Edit Account Form Submit
$('#editAccountForm').on('submit', function(e) {
    e.preventDefault();
    
    var accountId = $('#edit_id').val();
    var $btn = $('#btnSubmitEdit');
    var originalText = $btn.html();
    
    // Disable button and show loading
    $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Updating...');
    
    // Clear previous errors
    $(this).find('.is-invalid').removeClass('is-invalid');
    $(this).find('.invalid-feedback').remove();
    
    $.ajax({
        url: '/accounts/' + accountId,
        type: 'PUT',
        data: $(this).serialize(),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.success) {
                closeModal('editAccountModal');
                showAlert('success', response.message);
                loadAccounts(); // Refresh table
            }
        },
        error: function(xhr) {
            if (xhr.status === 422) {
                // Validation errors
                var errors = xhr.responseJSON.errors;
                $.each(errors, function(field, messages) {
                    var $input = $('#edit_' + field);
                    $input.addClass('is-invalid');
                    $input.after('<div class="invalid-feedback">' + messages[0] + '</div>');
                });
            } else {
                showAlert('danger', 'An error occurred. Please try again.');
            }
        },
        complete: function() {
            $btn.prop('disabled', false).html(originalText);
        }
    });
});
</script>

<!-- Delete Account Script (DELETE) -->
<script>
// Open Delete Confirmation Modal
function openDeleteModal(accountId, accountTitle) {
    $('#delete_id').val(accountId);
    $('#deleteAccountName').text('"' + accountTitle + '"');
    openModal('deleteAccountModal');
}

// Handle Delete Confirmation
$('#btnConfirmDelete').on('click', function() {
    var accountId = $('#delete_id').val();
    var $btn = $(this);
    var originalText = $btn.html();
    
    // Disable button and show loading
    $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Deleting...');
    
    $.ajax({
        url: '/accounts/' + accountId,
        type: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.success) {
                closeModal('deleteAccountModal');
                showAlert('success', response.message);
                loadAccounts(); // Refresh table
            }
        },
        error: function(xhr) {
            closeModal('deleteAccountModal');
            showAlert('danger', 'Failed to delete account. Please try again.');
        },
        complete: function() {
            $btn.prop('disabled', false).html(originalText);
        }
    });
});
</script>
@endpush
