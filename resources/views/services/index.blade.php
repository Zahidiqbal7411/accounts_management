@extends('layouts.app')

@section('title', 'Services')

@section('content')
<!-- Toast Container -->
<div id="toastContainer"></div>

<div class="services-container">
    <!-- Header with Add Button on Right -->
    <div class="services-header">
        <h2 class="services-title">Manage Services</h2>
        <button class="btn btn-primary" id="btnAddService">
            <i class="fas fa-plus"></i> Add New Service
        </button>
    </div>

    <!-- Services Table -->
    <div class="table-container">
        <table class="services-table" id="servicesTable">
            <thead>
                <tr>
                    <th style="width: 50px;">#</th>
                    <th style="width: 18%;">Title</th>
                    <th style="width: 12%;">Account</th>
                    <th style="width: 12%;">Product</th>
                    <th style="width: 15%;">Contact</th>
                    <th style="width: 10%;">Start Date</th>
                    <th style="width: 10%;">Due Date</th>
                    <th style="width: 8%;">Status</th>
                    <th style="width: 140px;">Actions</th>
                </tr>
            </thead>
            <tbody id="servicesTableBody">
                <!-- Data will be loaded via jQuery -->
            </tbody>
        </table>
    </div>
</div>

<!-- Add Service Modal -->
<div class="modal-overlay" id="addServiceModal">
    <div class="modal modal-lg">
        <div class="modal-header">
            <h3><i class="fas fa-cogs"></i> Add New Service</h3>
            <button class="modal-close" onclick="closeModal('addServiceModal')">&times;</button>
        </div>
        <form id="addServiceForm">
            <div class="modal-body">
                <div class="form-group">
                    <label for="ac_id">Account Title</label>
                    <select id="ac_id" name="ac_id" class="form-control">
                        <option value="">Select Account</option>
                        @foreach($accounts as $account)
                            <option value="{{ $account->ac_id }}">{{ $account->ac_title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="pro_id">Hosting</label>
                        <select id="pro_id" name="pro_id" class="form-control">
                            <option value="">Select Hosting</option>
                            @foreach($products as $product)
                                <option value="{{ $product->pro_id }}">{{ $product->pro_title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="service_domain">Select Domain</label>
                        <select id="service_domain" name="service_domain" class="form-control">
                            <option value="">Select Domain</option>
                            @foreach($products as $product)
                                <option value="{{ $product->pro_id }}">{{ $product->pro_title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="pro_link">Software Link</label>
                    <input type="text" id="pro_link" name="pro_link" class="form-control" placeholder="Enter software link">
                </div>
                <div class="form-group">
                    <label for="service_title">Service Title <span class="required">*</span></label>
                    <input type="text" id="service_title" name="service_title" class="form-control" required placeholder="Enter service title">
                </div>
                <div class="form-group">
                    <label for="service_description">Business Address</label>
                    <textarea id="service_description" name="service_description" class="form-control" placeholder="Enter business address" rows="3"></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="service_email">Business Email</label>
                        <input type="email" id="service_email" name="service_email" class="form-control" placeholder="Enter business email">
                    </div>
                    <div class="form-group">
                        <label for="service_contact">Business Contact</label>
                        <input type="text" id="service_contact" name="service_contact" class="form-control" placeholder="Enter business contact number">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="service_person">Contact Person (Primary)</label>
                        <input type="text" id="service_person" name="service_person" class="form-control" placeholder="Enter primary contact person name" maxlength="45">
                    </div>
                    <div class="form-group">
                        <label for="service_person_contact">Contact</label>
                        <input type="text" id="service_person_contact" name="service_person_contact" class="form-control" placeholder="Enter contact" maxlength="45">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="service_person2">Contact Person (Secondary)</label>
                        <input type="text" id="service_person2" name="service_person2" class="form-control" placeholder="Enter secondary contact person name" maxlength="45">
                    </div>
                    <div class="form-group">
                        <label for="service_person2_contact">Contact</label>
                        <input type="text" id="service_person2_contact" name="service_person2_contact" class="form-control" placeholder="Enter contact" maxlength="45">
                    </div>
                </div>
                <!-- Person Email hidden temporarily -->
                <div class="form-group" style="display: none;">
                    <label for="service_personemail">Person Email</label>
                    <input type="email" id="service_personemail" name="service_personemail" class="form-control" placeholder="Enter person email" maxlength="45">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="service_start_date">Start Date <span class="required">*</span></label>
                        <input type="date" id="service_start_date" name="service_start_date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="service_due_date">Due Date <span class="required">*</span></label>
                        <input type="date" id="service_due_date" name="service_due_date" class="form-control" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="service_status">Status</label>
                        <select id="service_status" name="service_status" class="form-control">
                            @foreach($serviceStatuses as $id => $name)
                                <option value="{{ $id }}" {{ $id == 1 ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="service_paid_status">Payment Status</label>
                        <select id="service_paid_status" name="service_paid_status" class="form-control">
                            <option value="0">Unpaid</option>
                            <option value="1">Paid</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="service_additional_detail">Service Additional Detail</label>
                    <textarea id="service_additional_detail" name="service_additional_detail" class="form-control" placeholder="Enter service additional details" rows="3"></textarea>
                </div>
                <div class="form-row-3">
                    <div class="form-group">
                        <label for="service_db">Service DB</label>
                        <input type="text" id="service_db" name="service_db" class="form-control" placeholder="Enter service database name">
                    </div>
                    <div class="form-group">
                        <label for="service_db_user">Service DB User</label>
                        <input type="text" id="service_db_user" name="service_db_user" class="form-control" placeholder="Enter database username">
                    </div>
                    <div class="form-group">
                        <label for="service_db_password">Service DB Password</label>
                        <input type="text" id="service_db_password" name="service_db_password" class="form-control" placeholder="Enter database password">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('addServiceModal')">Cancel</button>
                <button type="submit" class="btn btn-primary" id="btnSubmitAdd">
                    <i class="fas fa-save"></i> Create Service
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Service Modal -->
<div class="modal-overlay" id="editServiceModal">
    <div class="modal modal-lg">
        <div class="modal-header">
            <h3><i class="fas fa-edit"></i> Edit Service</h3>
            <button class="modal-close" onclick="closeModal('editServiceModal')">&times;</button>
        </div>
        <form id="editServiceForm">
            <input type="hidden" id="edit_id" name="id">
            <div class="modal-body">
                <div class="form-group">
                    <label for="edit_ac_id">Account Title</label>
                    <select id="edit_ac_id" name="ac_id" class="form-control">
                        <option value="">Select Account</option>
                        @foreach($accounts as $account)
                            <option value="{{ $account->ac_id }}">{{ $account->ac_title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="edit_pro_id">Hosting</label>
                        <select id="edit_pro_id" name="pro_id" class="form-control">
                            <option value="">Select Hosting</option>
                            @foreach($products as $product)
                                <option value="{{ $product->pro_id }}">{{ $product->pro_title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_service_domain">Select Domain</label>
                        <select id="edit_service_domain" name="service_domain" class="form-control">
                            <option value="">Select Domain</option>
                            @foreach($products as $product)
                                <option value="{{ $product->pro_id }}">{{ $product->pro_title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_pro_link">Software Link</label>
                    <input type="text" id="edit_pro_link" name="pro_link" class="form-control" placeholder="Enter software link">
                </div>
                <div class="form-group">
                    <label for="edit_service_title">Service Title <span class="required">*</span></label>
                    <input type="text" id="edit_service_title" name="service_title" class="form-control" required placeholder="Enter service title">
                </div>
                <div class="form-group">
                    <label for="edit_service_description">Business Address</label>
                    <textarea id="edit_service_description" name="service_description" class="form-control" placeholder="Enter business address" rows="3"></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="edit_service_email">Business Email</label>
                        <input type="email" id="edit_service_email" name="service_email" class="form-control" placeholder="Enter business email">
                    </div>
                    <div class="form-group">
                        <label for="edit_service_contact">Business Contact</label>
                        <input type="text" id="edit_service_contact" name="service_contact" class="form-control" placeholder="Enter business contact number">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="edit_service_person">Contact Person (Primary)</label>
                        <input type="text" id="edit_service_person" name="service_person" class="form-control" placeholder="Enter primary contact person name" maxlength="45">
                    </div>
                    <div class="form-group">
                        <label for="edit_service_person_contact">Contact</label>
                        <input type="text" id="edit_service_person_contact" name="service_person_contact" class="form-control" placeholder="Enter contact" maxlength="45">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="edit_service_person2">Contact Person (Secondary)</label>
                        <input type="text" id="edit_service_person2" name="service_person2" class="form-control" placeholder="Enter secondary contact person name" maxlength="45">
                    </div>
                    <div class="form-group">
                        <label for="edit_service_person2_contact">Contact</label>
                        <input type="text" id="edit_service_person2_contact" name="service_person2_contact" class="form-control" placeholder="Enter contact" maxlength="45">
                    </div>
                </div>
                <!-- Person Email hidden temporarily -->
                <div class="form-group" style="display: none;">
                    <label for="edit_service_personemail">Person Email</label>
                    <input type="email" id="edit_service_personemail" name="service_personemail" class="form-control" placeholder="Enter person email" maxlength="45">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="edit_service_start_date">Start Date <span class="required">*</span></label>
                        <input type="date" id="edit_service_start_date" name="service_start_date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_service_due_date">Due Date <span class="required">*</span></label>
                        <input type="date" id="edit_service_due_date" name="service_due_date" class="form-control" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="edit_service_status">Status</label>
                        <select id="edit_service_status" name="service_status" class="form-control">
                            @foreach($serviceStatuses as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_service_paid_status">Payment Status</label>
                        <select id="edit_service_paid_status" name="service_paid_status" class="form-control">
                            <option value="0">Unpaid</option>
                            <option value="1">Paid</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_service_additional_detail">Service Additional Detail</label>
                    <textarea id="edit_service_additional_detail" name="service_additional_detail" class="form-control" placeholder="Enter service additional details" rows="3"></textarea>
                </div>
                <div class="form-row-3">
                    <div class="form-group">
                        <label for="edit_service_db">Service DB</label>
                        <input type="text" id="edit_service_db" name="service_db" class="form-control" placeholder="Enter service database name">
                    </div>
                    <div class="form-group">
                        <label for="edit_service_db_user">Service DB User</label>
                        <input type="text" id="edit_service_db_user" name="service_db_user" class="form-control" placeholder="Enter database username">
                    </div>
                    <div class="form-group">
                        <label for="edit_service_db_password">Service DB Password</label>
                        <input type="text" id="edit_service_db_password" name="service_db_password" class="form-control" placeholder="Enter database password">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('editServiceModal')">Cancel</button>
                <button type="submit" class="btn btn-primary" id="btnSubmitEdit">
                    <i class="fas fa-save"></i> Update Service
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal-overlay" id="deleteServiceModal">
    <div class="modal modal-sm">
        <div class="modal-header">
            <h3><i class="fas fa-exclamation-triangle text-danger"></i> Confirm Delete</h3>
            <button class="modal-close" onclick="closeModal('deleteServiceModal')">&times;</button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="delete_id">
            <p class="text-center">Are you sure you want to delete this service?</p>
            <p class="text-center text-muted" id="deleteServiceName"></p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeModal('deleteServiceModal')">Cancel</button>
            <button type="button" class="btn btn-delete" id="btnConfirmDelete">
                <i class="fas fa-trash"></i> Delete
            </button>
        </div>
    </div>
</div>

<!-- View Service Modal -->
<div class="modal-overlay" id="viewServiceModal">
    <div class="modal modal-lg">
        <div class="modal-header">
            <h3><i class="fas fa-eye"></i> Service Details</h3>
            <button class="modal-close" onclick="closeModal('viewServiceModal')">&times;</button>
        </div>
        <div class="modal-body">
            <div id="viewServiceContent">
                <!-- Service details will be loaded here -->
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeModal('viewServiceModal')">Close</button>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Services Page Styles */
.services-container {
    max-width: 100%;
}

.services-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
}

.services-title {
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

.btn-view {
    background: #10b981;
    color: #fff;
}

.btn-view:hover {
    background: #059669;
}

/* Table Styles */
.table-container {
    background: var(--bg-white);
    border-radius: 12px;
    box-shadow: var(--shadow);
    overflow-x: auto;
}

.services-table {
    width: 100%;
    border-collapse: collapse;
    table-layout: auto;
}

.services-table th,
.services-table td {
    padding: 14px 16px;
    text-align: left;
    border-bottom: 1px solid var(--border);
    white-space: nowrap;
}

.services-table th {
    background: #f8fafc;
    font-weight: 600;
    font-size: 13px;
    color: var(--text-gray);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    position: relative;
    resize: horizontal;
    overflow: auto;
}

.services-table td {
    max-width: 200px;
    overflow: hidden;
    text-overflow: ellipsis;
}

.services-table tbody tr:hover {
    background: #f8fafc;
}

.services-table tbody tr:last-child td {
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

/* Status Badges */
.badge {
    display: inline-flex;
    align-items: center;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 500;
}

.badge-success {
    background: #d1fae5;
    color: #065f46;
}

.badge-danger {
    background: #fee2e2;
    color: #991b1b;
}

.badge-warning {
    background: #fef3c7;
    color: #92400e;
}

.badge-info {
    background: #dbeafe;
    color: #1e40af;
}

.badge-secondary {
    background: #e5e7eb;
    color: #4b5563;
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

.modal-lg {
    max-width: 700px;
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

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
    margin-bottom: 16px;
}

.form-row .form-group {
    margin-bottom: 0;
}

.form-row-3 {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 16px;
    margin-bottom: 16px;
}

.form-row-3 .form-group {
    margin-bottom: 0;
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

textarea.form-control {
    resize: vertical;
    min-height: 80px;
}

select.form-control {
    cursor: pointer;
}

/* View Details Styles */
.detail-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 20px;
}

.detail-grid:last-child {
    margin-bottom: 0;
}

.detail-section {
    background: #ffffff;
    border-radius: 16px;
    padding: 20px;
    border: 1px solid rgba(79, 70, 229, 0.1);
    box-shadow: 0 4px 20px rgba(79, 70, 229, 0.08);
    position: relative;
    overflow: hidden;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.detail-section:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 30px rgba(79, 70, 229, 0.12);
}

.detail-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #4f46e5 0%, #7c3aed 50%, #a855f7 100%);
    border-radius: 16px 16px 0 0;
}

.detail-section-title {
    font-size: 12px;
    font-weight: 700;
    color: #4f46e5;
    margin-bottom: 18px;
    padding-bottom: 12px;
    border-bottom: 1px solid #e5e7eb;
    text-transform: uppercase;
    letter-spacing: 1px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.detail-section-title::before {
    content: '';
    width: 8px;
    height: 8px;
    background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
    border-radius: 50%;
    box-shadow: 0 0 8px rgba(79, 70, 229, 0.5);
}

.detail-item {
    display: flex;
    flex-direction: column;
    padding: 12px 0;
    border-bottom: 1px solid #f3f4f6;
    transition: background 0.2s ease;
}

.detail-item:hover {
    background: linear-gradient(90deg, rgba(79, 70, 229, 0.02) 0%, transparent 100%);
    margin: 0 -12px;
    padding: 12px;
    border-radius: 8px;
}

.detail-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.detail-item:first-child {
    padding-top: 0;
}

.detail-label {
    font-size: 10px;
    font-weight: 700;
    color: #9ca3af;
    text-transform: uppercase;
    letter-spacing: 1.2px;
    margin-bottom: 6px;
    display: flex;
    align-items: center;
    gap: 6px;
}

.detail-label::before {
    content: '›';
    color: #4f46e5;
    font-size: 12px;
    font-weight: bold;
}

.detail-value {
    font-size: 14px;
    font-weight: 500;
    color: #1f2937;
    line-height: 1.6;
    word-break: break-word;
    padding-left: 14px;
}

.detail-value:empty::after {
    content: '—';
    color: #d1d5db;
}

.detail-value a {
    color: #4f46e5;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

.detail-value a:hover {
    color: #7c3aed;
    text-decoration: underline;
}

.detail-value a::after {
    content: '↗';
    font-size: 10px;
    opacity: 0.6;
}

.detail-value .badge {
    font-size: 11px;
    padding: 6px 14px;
    font-weight: 600;
    border-radius: 20px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

/* Responsive */
@media (max-width: 768px) {
    .services-header {
        flex-direction: column;
        gap: 16px;
        align-items: stretch;
    }
    
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .detail-grid {
        grid-template-columns: 1fr;
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

<!-- Retrieve Services Script (GET) -->
<script>
// Load services from server
function loadServices() {
    $('#servicesTableBody').html(`
        <tr>
            <td colspan="9" class="loading-state">
                <i class="fas fa-spinner"></i>
                <p>Loading services...</p>
            </td>
        </tr>
    `);

    $.ajax({
        url: '{{ route("services.index") }}',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success && response.data.length > 0) {
                renderServicesTable(response.data);
            } else {
                $('#servicesTableBody').html(`
                    <tr>
                        <td colspan="9" class="text-center empty-state">
                            <i class="fas fa-folder-open"></i>
                            <p>No services found. Click "Add New Service" to create one.</p>
                        </td>
                    </tr>
                `);
            }
        },
        error: function(xhr) {
            $('#servicesTableBody').html(`
                <tr>
                    <td colspan="9" class="text-center empty-state">
                        <i class="fas fa-exclamation-triangle text-danger"></i>
                        <p>Error loading services. Please refresh the page.</p>
                    </td>
                </tr>
            `);
        }
    });
}

// Render services table
// Status badge mapping
var statusBadges = {
    1: '<span class="badge badge-success">Active</span>',
    2: '<span class="badge badge-danger">Inactive</span>',
    3: '<span class="badge badge-warning">Suspended</span>',
    4: '<span class="badge badge-info">Terminated</span>'
};

function renderServicesTable(services) {
    var html = '';
    $.each(services, function(index, service) {
        var startDate = service.service_start_date ? new Date(service.service_start_date).toLocaleDateString() : '-';
        var dueDate = service.service_due_date ? new Date(service.service_due_date).toLocaleDateString() : '-';
        var accountName = service.account ? escapeHtml(service.account.ac_title) : '-';
        var productName = service.product ? escapeHtml(service.product.pro_title) : '-';
        var statusBadge = statusBadges[service.service_status] || '<span class="badge badge-secondary">Unknown</span>';
        
        html += `
            <tr data-id="${service.service_id}">
                <td>${index + 1}</td>
                <td title="${escapeHtml(service.service_title)}">${escapeHtml(service.service_title)}</td>
                <td title="${accountName}">${accountName}</td>
                <td title="${productName}">${productName}</td>
                <td title="${escapeHtml(service.service_contact)}">${escapeHtml(service.service_contact)}</td>
                <td>${startDate}</td>
                <td>${dueDate}</td>
                <td>${statusBadge}</td>
                <td class="actions-cell">
                    <button class="btn btn-sm btn-view" onclick="openViewServiceModal(${service.service_id})">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button class="btn btn-sm btn-edit" onclick='openEditServiceModal(${JSON.stringify(service)})'>
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn btn-sm btn-delete" onclick="openDeleteModal(${service.service_id}, '${escapeHtml(service.service_title)}')">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
        `;
    });
    $('#servicesTableBody').html(html);
}

// Helper functions
function escapeHtml(text) {
    if (!text) return '';
    var div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// Load services on page load
$(document).ready(function() {
    loadServices();
});
</script>

<!-- Submit Service Script (CREATE) -->
<script>
// Open Add Modal
$('#btnAddService').on('click', function() {
    // Reset form
    $('#addServiceForm')[0].reset();
    $('#addServiceForm .is-invalid').removeClass('is-invalid');
    $('#addServiceForm .invalid-feedback').remove();
    openModal('addServiceModal');
});

// Handle Add Service Form Submit
$('#addServiceForm').on('submit', function(e) {
    e.preventDefault();
    
    var $btn = $('#btnSubmitAdd');
    var originalText = $btn.html();
    
    // Disable button and show loading
    $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Creating...');
    
    // Clear previous errors
    $(this).find('.is-invalid').removeClass('is-invalid');
    $(this).find('.invalid-feedback').remove();
    
    $.ajax({
        url: '{{ route("services.store") }}',
        type: 'POST',
        data: $(this).serialize(),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.success) {
                closeModal('addServiceModal');
                showAlert('success', response.message);
                loadServices(); // Refresh table
                $('#addServiceForm')[0].reset();
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

<!-- Edit Service Script (UPDATE) -->
<script>
// Open Edit Modal with service data
function openEditServiceModal(service) {
    // Reset form
    $('#editServiceForm .is-invalid').removeClass('is-invalid');
    $('#editServiceForm .invalid-feedback').remove();
    
    // Populate form fields
    $('#edit_id').val(service.service_id);
    $('#edit_ac_id').val(service.ac_id);
    $('#edit_pro_id').val(service.pro_id);
    $('#edit_service_title').val(service.service_title);
    $('#edit_service_description').val(service.service_description);
    $('#edit_service_email').val(service.service_email);
    $('#edit_service_contact').val(service.service_contact);
    $('#edit_pro_link').val(service.pro_link);
    $('#edit_service_domain').val(service.service_domain);
    $('#edit_service_person').val(service.service_person);
    $('#edit_service_person_contact').val(service.service_person_contact);
    $('#edit_service_person2').val(service.service_person2);
    $('#edit_service_person2_contact').val(service.service_person2_contact);
    $('#edit_service_personemail').val(service.service_personemail);
    $('#edit_service_start_date').val(service.service_start_date ? service.service_start_date.split('T')[0] : '');
    $('#edit_service_due_date').val(service.service_due_date ? service.service_due_date.split('T')[0] : '');
    $('#edit_service_status').val(service.service_status);
    $('#edit_service_paid_status').val(service.service_paid_status);
    $('#edit_service_additional_detail').val(service.service_additional_detail);
    $('#edit_service_db').val(service.service_db);
    $('#edit_service_db_user').val(service.service_db_user);
    $('#edit_service_db_password').val(service.service_db_password);
    
    openModal('editServiceModal');
}

// Handle Edit Service Form Submit
$('#editServiceForm').on('submit', function(e) {
    e.preventDefault();
    
    var serviceId = $('#edit_id').val();
    var $btn = $('#btnSubmitEdit');
    var originalText = $btn.html();
    
    // Disable button and show loading
    $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Updating...');
    
    // Clear previous errors
    $(this).find('.is-invalid').removeClass('is-invalid');
    $(this).find('.invalid-feedback').remove();
    
    $.ajax({
        url: '/services/' + serviceId,
        type: 'PUT',
        data: $(this).serialize(),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.success) {
                closeModal('editServiceModal');
                showAlert('success', response.message);
                loadServices(); // Refresh table
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

<!-- Delete Service Script (DELETE) -->
<script>
// Open Delete Confirmation Modal
function openDeleteModal(serviceId, serviceTitle) {
    $('#delete_id').val(serviceId);
    $('#deleteServiceName').text('"' + serviceTitle + '"');
    openModal('deleteServiceModal');
}

// Handle Delete Confirmation
$('#btnConfirmDelete').on('click', function() {
    var serviceId = $('#delete_id').val();
    var $btn = $(this);
    var originalText = $btn.html();
    
    // Disable button and show loading
    $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Deleting...');
    
    $.ajax({
        url: '/services/' + serviceId,
        type: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.success) {
                closeModal('deleteServiceModal');
                showAlert('success', response.message);
                loadServices(); // Refresh table
            }
        },
        error: function(xhr) {
            closeModal('deleteServiceModal');
            showAlert('danger', 'Failed to delete service. Please try again.');
        },
        complete: function() {
            $btn.prop('disabled', false).html(originalText);
        }
    });
});
</script>

<!-- View Service Script (SHOW) -->
<script>
// Open View Service Modal
function openViewServiceModal(serviceId) {
    // Show loading
    $('#viewServiceContent').html('<div class="text-center"><i class="fas fa-spinner fa-spin" style="font-size: 32px; margin: 20px 0;"></i><p>Loading service details...</p></div>');
    openModal('viewServiceModal');
    
    $.ajax({
        url: '/services/' + serviceId,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                renderServiceDetails(response.data);
            } else {
                $('#viewServiceContent').html('<p class="text-center text-danger">Error loading service details.</p>');
            }
        },
        error: function(xhr) {
            $('#viewServiceContent').html('<p class="text-center text-danger">Error loading service details. Please try again.</p>');
        }
    });
}

// Render service details in modal
function renderServiceDetails(service) {
    var accountName = service.account ? service.account.ac_title : '-';
    var productName = service.product ? service.product.pro_title : '-';
    var startDate = service.service_start_date ? new Date(service.service_start_date).toLocaleDateString() : '-';
    var dueDate = service.service_due_date ? new Date(service.service_due_date).toLocaleDateString() : '-';
    var statusBadge = service.service_status == 1 
        ? '<span class="badge badge-success">Active</span>' 
        : '<span class="badge badge-danger">Inactive</span>';
    var paidBadge = service.service_paid_status == 1 
        ? '<span class="badge badge-success">Paid</span>' 
        : '<span class="badge badge-warning">Unpaid</span>';
    
    var html = `
        <div class="detail-grid">
            <div class="detail-section">
                <div class="detail-section-title">Basic Information</div>
                <div class="detail-item">
                    <div class="detail-label">Service Title</div>
                    <div class="detail-value">${escapeHtml(service.service_title) || '-'}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Description</div>
                    <div class="detail-value">${escapeHtml(service.service_description) || '-'}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Account</div>
                    <div class="detail-value">${escapeHtml(accountName)}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Product</div>
                    <div class="detail-value">${escapeHtml(productName)}</div>
                </div>
            </div>
            
            <div class="detail-section">
                <div class="detail-section-title">Contact Information</div>
                <div class="detail-item">
                    <div class="detail-label">Email</div>
                    <div class="detail-value">${escapeHtml(service.service_email) || '-'}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Contact</div>
                    <div class="detail-value">${escapeHtml(service.service_contact) || '-'}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Product Link</div>
                    <div class="detail-value">${service.pro_link ? '<a href="'+escapeHtml(service.pro_link)+'" target="_blank">'+escapeHtml(service.pro_link)+'</a>' : '-'}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Domain Count</div>
                    <div class="detail-value">${service.service_domain || '-'}</div>
                </div>
            </div>
        </div>
        
        <div class="detail-grid">
            <div class="detail-section">
                <div class="detail-section-title">Primary Person</div>
                <div class="detail-item">
                    <div class="detail-label">Name</div>
                    <div class="detail-value">${escapeHtml(service.service_person) || '-'}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Contact</div>
                    <div class="detail-value">${escapeHtml(service.service_person_contact) || '-'}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Email</div>
                    <div class="detail-value">${escapeHtml(service.service_personemail) || '-'}</div>
                </div>
            </div>
            
            <div class="detail-section">
                <div class="detail-section-title">Secondary Person</div>
                <div class="detail-item">
                    <div class="detail-label">Name</div>
                    <div class="detail-value">${escapeHtml(service.service_person2) || '-'}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Contact</div>
                    <div class="detail-value">${escapeHtml(service.service_person2_contact) || '-'}</div>
                </div>
            </div>
        </div>
        
        <div class="detail-grid">
            <div class="detail-section">
                <div class="detail-section-title">Service Dates</div>
                <div class="detail-item">
                    <div class="detail-label">Start Date</div>
                    <div class="detail-value">${startDate}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Due Date</div>
                    <div class="detail-value">${dueDate}</div>
                </div>
            </div>
            
            <div class="detail-section">
                <div class="detail-section-title">Status</div>
                <div class="detail-item">
                    <div class="detail-label">Service Status</div>
                    <div class="detail-value">${statusBadge}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Payment Status</div>
                    <div class="detail-value">${paidBadge}</div>
                </div>
            </div>
        </div>
    `;
    
    $('#viewServiceContent').html(html);
}
</script>
@endpush
