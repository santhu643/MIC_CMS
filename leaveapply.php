<head>
    <link href="css/modal.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <style>
        .alertify-notifier .ajs-error {
            background: linear-gradient(to bottom right, #003300 16%, #ff0000 100%);
            color: #ffffff;
        }

        .alertify-notifier .ajs-success {
            background: blue;
            color: #ffffff;
        }
    </style>
</head>

<body>
    <button class="btn btn-primary mb-2 mr-md-4" onclick="openModal('applyLeave')">
        Apply Leave
    </button>
    <button class="btn btn-secondary mb-2 mr-md-4" onclick="openModal('applyOD')">
        Apply OD
    </button>
    <button class="btn btn-success mb-2 mr-md-4" onclick="openModal('applyPermission')">
        Apply Permission
    </button>
    <button class="btn btn-danger mb-2 mr-md-4" onclick="openModal('requestCOL')">
        Request COL
    </button>
    <button class="btn btn-info mb-2" onclick="openModal('requestOD')">
        Request OD Research
    </button>


    <!-- Leave Application Modal -->
    <div id="applyLeave" class="modal">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4>Apply for Leave</h4>
                <span class="close" onclick="closeModal('applyLeave')">&times;</span>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form class="bg-white" id="leaveForm" method="post">
                    <div class="mb-3">
                        <label for="leaveType" class="form-label fw-bold mb-1">Select Type of Leave</label>
                        <select id="leaveType" class="form-select custom-select" name="leaveType" required>
                            <option value="">Select Leave Type</option>
                            <option value="Casual Leave">Casual Leave (CL)</option>
                            <option value="Compensation Leave">Compensation Leave (COL)</option>
                            <option value="Vacation Leave">Vacation Leave (VL)</option>
                            <option value="Medical Leave">Medical Leave (ML)</option>
                            <option value="Marriage Leave">Marriage Leave (MAL)</option>
                            <option value="Maternity Leave">Maternity Leave (MTL)</option>
                            <option value="Paternity Leave">Paternity Leave (PTL)</option>
                            <option value="Study Leave">Study Leave (SL)</option>
                            <option value="Special Leave">Special Leave (SPL)</option>
                        </select>
                    </div>

                    <!-- Dates and Shifts Section -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="fromDate" class="form-label fw-bold mb-1">From Date</label>
                            <input type="date" id="fromDate" class="form-control" name="fromDate" required />
                        </div>
                        <div class="col-md-6">
                            <label for="fromShift" class="form-label fw-bold mb-1">Shift</label>
                            <select id="fromShift" class="form-select custom-select" name="fromShift" required>
                                <option value="">Select Shift</option>
                                <option value="Full Day">Full Day</option>
                                <option value="Half Day">Half Day</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="toDate" class="form-label fw-bold mb-1">To Date</label>
                            <input type="date" id="toDate" class="form-control" name="toDate" required />
                        </div>
                        <div class="col-md-6">
                            <label for="toShift" class="form-label fw-bold mb-1">Shift</label>
                            <select id="toShift" class="form-select custom-select" name="toShift" required>
                                <option value="">Select Shift</option>
                                <option value="Full Day">Full Day</option>
                                <option value="Half Day">Half Day</option>
                            </select>
                        </div>
                    </div>

                    <!-- Total Days & Reason Section -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="totalDays" class="form-label fw-bold mb-1">Total Days</label>
                            <input type="text" id="totalDays" class="form-control bg-light" name="totalDays" readonly
                                required />
                        </div>
                        <div class="col-md-6 d-flex align-items-end">
                            <button type="button" class="btn btn-primary me-2 mt-3" id="calculateTotalDays">
                                Calculate
                            </button>
                            <button type="button" class="btn btn-danger me-2 mt-3" id="resetForm"
                                style="display: none;">
                                Reset
                            </button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="reason" class="form-label fw-bold mb-1">Reason</label>
                        <textarea id="reason" rows="3" name="reason" class="form-control" required></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="modal-footer">
                        <button class="btn modal-button-secondary" type="button"
                            onclick="closeModal('applyLeave')">Cancel</button>
                        <button type="submit" class="btn modal-button-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Leave Application Modal end -->


    <!-- OD Application Modal -->

    <div id="applyOD" class="modal">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4>Apply for OnDuty</h4>
                <span class="close" onclick="closeModal('applyOD')">&times;</span>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form class="bg-white" id="onDutyForm" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="ODType" class="form-label fw-bold mb-1">Select Type of OnDuty</label>
                        <select id="ODType" class="form-select custom-select" name="leave" required>
                            <option value="">Select OnDuty Type</option>
                            <option value="OnDuty Basic">OnDuty Basic (ODB)</option>
                            <option value="On Duty Research">On Duty Research (ODR) (Scholar / Supervisior)</option>
                            <option value="On Duty Professional">On Duty Professional (ODP) (FDP / Seminars / Workshop /
                                Conference)</option>
                            <option value="On Duty Outreach">On Duty Outreach (ODO) (Valuation / Examiner)</option>
                        </select>
                    </div>

                    <!-- Dates and Shifts Section -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="fromDate" class="form-label fw-bold mb-1">From Date</label>
                            <input type="date" id="fromDate2" class="form-control" name="fromDate" required />
                        </div>
                        <div class="col-md-6">
                            <label for="fromShift" class="form-label fw-bold mb-1">Shift</label>
                            <select id="fromShift2" class="form-select custom-select" name="fromShift" required>
                                <option value="">Select Shift</option>
                                <option value="Full Day">Full Day</option>
                                <option value="Half Day">Half Day</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="toDate" class="form-label fw-bold mb-1">To Date</label>
                            <input type="date" id="toDate2" class="form-control" name="toDate" required />
                        </div>
                        <div class="col-md-6">
                            <label for="toShift" class="form-label fw-bold mb-1">Shift</label>
                            <select id="toShift2" class="form-select custom-select" name="toShift" required>
                                <option value="">Select Shift</option>
                                <option value="Full Day">Full Day</option>
                                <option value="Half Day">Half Day</option>
                            </select>
                        </div>
                    </div>

                    <!-- Total Days Section -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="totalDays" class="form-label fw-bold mb-1">Total Days</label>
                            <input type="text" id="totalDays2" class="form-control bg-light" name="tdays" readonly
                                required />
                            <div class="text-danger" id="totalDaysError" style="display: none;">
                                Total days should be more than 0
                            </div>
                        </div>
                        <div class="col-md-6 d-flex align-items-end">
                            <button type="button" class="btn btn-primary me-2 mt-3" id="calculateBtn">Calculate</button>
                            <button type="button" class="btn btn-danger me-2 mt-3" id="resetBtn"
                                style="display: none;">Reset</button>
                        </div>
                    </div>

                    <!-- Reason and File Upload Section -->
                    <div class="mb-3">
                        <label for="reason" class="form-label fw-bold mb-1">Reason</label>
                        <textarea id="ODreason" rows="3" name="ODreason" class="form-control" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="uploadFile" class="form-label fw-bold mb-1">Upload File</label>
                        <input type="file" id="uploadFile" name="odfile" accept=".pdf, image/*" class="form-control" />
                        <small class="form-text text-muted">Select PDF or image only. Size should be below 2MB.</small>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="modal-footer">
                        <button class="btn modal-button-secondary" type="button"
                            onclick="closeModal('applyOD')">Cancel</button>
                        <button type="submit" class="btn modal-button-primary od_submit-btn" id="submitBtn"
                            disabled>Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- OD Application Modal end -->


    <!-- Permission Application Modal -->
    <div id="applyPermission" class="modal">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4>Apply for Permission</h4>
                <span class="close" onclick="closeModal('applyPermission')">&times;</span>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form class="bg-white" id="permissionForm" method="post">
                    <div class="mb-3">
                        <label for="permissionType" class="form-label fw-bold mb-1">Select Type of Permission</label>
                        <select id="permissionType" class="form-select custom-select" name="permissionType" required>
                            <option value="">Select Permission Type</option>
                            <option value="Morning">Morning</option>
                            <option value="Evening">Evening</option>
                            <option value="10minM">10min Morning</option>
                            <option value="10minE">10min Evening</option>
                        </select>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="permissionDate" class="form-label fw-bold mb-1">Date</label>
                            <input type="date" id="permissionDate" class="form-control" name="permissionDate"
                                required />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="reason" class="form-label fw-bold mb-1">Reason</label>
                        <textarea id="preason" rows="3" name="preason" class="form-control" required></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="modal-footer">
                        <button class="btn modal-button-secondary" type="button"
                            onclick="closeModal('applyPermission')">Cancel</button>
                        <button type="submit" class="btn modal-button-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Permission Application Modal end -->


    <!-- COL Application Modal -->
    <div id="requestCOL" class="modal">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4>Request Compensation Leave</h4>
                <span class="close" onclick="closeModal('requestCOL')">&times;</span>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form class="bg-white" id="colForm" method="post">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="fromDate" class="form-label fw-bold mb-1">Date</label>
                            <input type="date" id="fromDate3" class="form-control" name="fromDate3" required />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="reason" class="form-label fw-bold mb-1">Reason</label>
                        <textarea id="colreason" rows="3" name="colreason" class="form-control" required></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="modal-footer">
                        <button class="btn modal-button-secondary" type="button"
                            onclick="closeModal('requestCOL')">Cancel</button>
                        <button type="submit" class="btn modal-button-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- COL Application Modal end -->


    <!-- ODR Application Modal -->
    <div id="requestOD" class="modal">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4>Request On Duty</h4>
                <span class="close" onclick="closeModal('requestOD')">&times;</span>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form class="bg-white" id="RodForm" method="post">
                    <!-- Dates and Shifts Section -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="fromDate4" class="form-label fw-bold mb-1">From Date</label>
                            <input type="date" id="fromDate4" class="form-control" name="fromDate4" required />
                        </div>
                        <div class="col-md-6">
                            <label for="fromShift4" class="form-label fw-bold mb-1">Shift</label>
                            <select id="fromShift4" class="form-select custom-select" name="fromShift4" required>
                                <option value="">Select Shift</option>
                                <option value="Full Day">Full Day</option>
                                <option value="Half Day">Half Day</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="toDate4" class="form-label fw-bold mb-1">To Date</label>
                            <input type="date" id="toDate4" class="form-control" name="toDate4" required />
                        </div>
                        <div class="col-md-6">
                            <label for="toShift4" class="form-label fw-bold mb-1">Shift</label>
                            <select id="toShift4" class="form-select custom-select" name="toShift4" required>
                                <option value="">Select Shift</option>
                                <option value="Full Day">Full Day</option>
                                <option value="Half Day">Half Day</option>
                            </select>
                        </div>
                    </div>

                    <!-- Total Days & Calculate Section -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="totalDays4" class="form-label fw-bold mb-1">Total Days</label>
                            <input type="text" id="totalDays4" class="form-control bg-light" name="tdays4" readonly
                                required />
                            <div class="text-danger d-none" id="totalDaysError">Total days should be more than 0</div>
                        </div>
                        <div class="col-md-6 d-flex align-items-end">
                            <button type="button" class="btn btn-primary me-2 mt-3"
                                id="calculateODRBtn">Calculate</button>
                            <button type="button" class="btn btn-danger me-2 mt-3" id="resetODRBtn"
                                style="display: none;">Reset</button>
                        </div>
                    </div>

                    <!-- Reason Section -->
                    <div class="mb-3">
                        <label for="reason" class="form-label fw-bold mb-1">Reason</label>
                        <textarea id="ODRreason" rows="3" name="ODRreason" class="form-control" required></textarea>
                    </div>

                    <!-- File Upload Section -->
                    <div class="mb-3">
                        <label for="uploadODRFile" class="form-label fw-bold mb-1">Upload File</label>
                        <input type="file" id="uploadODRFile" name="odRfile" accept=".pdf, image/*"
                            class="form-control" />
                        <small class="form-text text-muted">Select PDF or image only. Size should be below 2MB.</small>
                    </div>

                    <!-- Submit Button -->
                    <div class="modal-footer">
                        <button class="btn modal-button-secondary" type="button"
                            onclick="closeModal('requestOD')">Cancel</button>
                        <button type="submit" class="btn modal-button-primary odr_submit-btn" id="submitBtn"
                            disabled>Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- ODR Application Modal end -->


    <script>

        // Modal functionality
        function openModal(modalId) {
            document.getElementById(modalId).style.display = "block";
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = "none";
        }

        // Sample calculation logic (replace with actual logic)
        function calculateLeaveDays(config) {
            const {
                fromDateId,
                toDateId,
                fromShiftId,
                toShiftId,
                totalDaysId,
                calculateButtonId,
                resetButtonId,
                submitButtonSelector
            } = config;

            document.getElementById(calculateButtonId).onclick = function () {
                const fromDate = document.getElementById(fromDateId);
                const toDate = document.getElementById(toDateId);
                const fromShift = document.getElementById(fromShiftId);
                const toShift = document.getElementById(toShiftId);

                // If toDate is empty, set it to be the same as fromDate
                if (!toDate.value) {
                    toDate.value = fromDate.value;
                    toShift.value = fromShift.value;
                }

                const fromDateObj = new Date(fromDate.value);
                const toDateObj = new Date(toDate.value);
                const oneDay = 24 * 60 * 60 * 1000;
                const diffDays = Math.round(Math.abs((toDateObj - fromDateObj) / oneDay));

                let totalDays = 0;

                if (diffDays === 0) {
                    // Same day logic
                    if (fromShift.value === "Full Day" || toShift.value === "Full Day") {
                        totalDays = 1; // Same day with at least one full shift counts as 1
                    } else {
                        totalDays = 0.5; // Same day with both half shifts counts as 0.5
                    }
                } else {
                    // Different days logic
                    if (fromShift.value === "Full Day" && toShift.value === "Full Day") {
                        totalDays = diffDays + 1; // Both shifts are full days
                    } else if (fromShift.value === "Half Day" && toShift.value === "Half Day") {
                        totalDays = diffDays; // First and last day are half, others are full
                    } else {
                        totalDays = diffDays + 0.5; // One full day, one half day
                    }
                }

                document.getElementById(totalDaysId).value = totalDays;
                document.querySelector(submitButtonSelector).disabled = false;

                $(this).hide();
                $(`#${resetButtonId}`).show();

                // Disable date inputs and shifts after calculation
                fromDate.disabled = true;
                toDate.disabled = true;
                fromShift.disabled = true;
                toShift.disabled = true;
            };
        }


        // For the first form
        calculateLeaveDays({
            fromDateId: 'fromDate',
            toDateId: 'toDate',
            fromShiftId: 'fromShift',
            toShiftId: 'toShift',
            totalDaysId: 'totalDays',
            calculateButtonId: 'calculateTotalDays',
            resetButtonId: 'resetForm',
            submitButtonSelector: 'button[type="submit"]'
        });

        // For the second form
        calculateLeaveDays({
            fromDateId: 'fromDate2',
            toDateId: 'toDate2',
            fromShiftId: 'fromShift2',
            toShiftId: 'toShift2',
            totalDaysId: 'totalDays2',
            calculateButtonId: 'calculateBtn',
            resetButtonId: 'resetBtn',
            submitButtonSelector: '.od_submit-btn'
        });
        // ODR
        calculateLeaveDays({
            fromDateId: 'fromDate4',
            toDateId: 'toDate4',
            fromShiftId: 'fromShift4',
            toShiftId: 'toShift4',
            totalDaysId: 'totalDays4',
            calculateButtonId: 'calculateODRBtn',
            resetButtonId: 'resetODRBtn',
            submitButtonSelector: '.odr_submit-btn'
        });

        function resetLeaveForm(formId, options) {
            const {
                fromDateId,
                toDateId,
                fromShiftId,
                toShiftId,
                submitButtonSelector,
                calculateButtonId,
                resetButtonId
            } = options;

            const form = document.getElementById(formId);
            form.reset();

            // Re-enable date inputs and shifts
            document.getElementById(fromDateId).disabled = false;
            document.getElementById(toDateId).disabled = false;
            document.getElementById(fromShiftId).disabled = false;
            document.getElementById(toShiftId).disabled = false;

            // Disable submit button
            document.querySelector(submitButtonSelector).disabled = true;

            // Hide reset button and show calculate button
            document.getElementById(resetButtonId).style.display = 'none';
            document.getElementById(calculateButtonId).style.display = 'block';
        }

        // Usage for first form
        document.getElementById('resetForm').onclick = function () {
            resetLeaveForm('leaveForm', {
                fromDateId: 'fromDate',
                toDateId: 'toDate',
                fromShiftId: 'fromShift',
                toShiftId: 'toShift',
                submitButtonSelector: 'button[type="submit"]',
                calculateButtonId: 'calculateTotalDays',
                resetButtonId: 'resetForm'
            });
        };

        // Usage for second form
        document.getElementById('resetBtn').onclick = function () {
            resetLeaveForm('onDutyForm', {
                fromDateId: 'fromDate2',
                toDateId: 'toDate2',
                fromShiftId: 'fromShift2',
                toShiftId: 'toShift2',
                submitButtonSelector: '.od_submit-btn',
                calculateButtonId: 'calculateBtn',
                resetButtonId: 'resetBtn'
            });
        };

        //odr form reset
        document.getElementById('resetODRBtn').onclick = function () {
            resetLeaveForm('RodForm', {
                fromDateId: 'fromDate4',
                toDateId: 'toDate4',
                fromShiftId: 'fromShift4',
                toShiftId: 'toShift4',
                submitButtonSelector: '.odr_submit-btn',
                calculateButtonId: 'calculateODRBtn',
                resetButtonId: 'resetODRBtn'
            });
        };

        // File upload validation
        $('#uploadFile').change(function () {
            const file = this.files[0];
            const fileType = file.type;
            const fileSize = file.size / 1024 / 1024; // in MB

            // Validate file type
            if (!fileType.match('image.*') && fileType !== 'application/pdf') {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid File Type',
                    text: 'Please upload only images or PDF files',
                });
                this.value = '';  // Reset the input
                return;
            }

            // Validate file size
            if (fileSize > 2) {
                Swal.fire({
                    icon: 'error',
                    title: 'File Too Large',
                    text: 'File size should be less than 2MB',
                });
                this.value = '';  // Reset the input
                return;
            }
        });

        $('#uploadODRFile').change(function () {
            const file = this.files[0];
            const fileType = file.type;
            const fileSize = file.size / 1024 / 1024; // in MB

            // Validate file type
            if (!fileType.match('image.*') && fileType !== 'application/pdf') {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid File Type',
                    text: 'Please upload only images or PDF files',
                });
                this.value = '';  // Reset the input
                return;
            }

            // Validate file size
            if (fileSize > 2) {
                Swal.fire({
                    icon: 'error',
                    title: 'File Too Large',
                    text: 'File size should be less than 2MB',
                });
                this.value = '';  // Reset the input
                return;
            }
        });




        //handle submit leave form
        $(document).on('submit', '#leaveForm', function (e) {
            e.preventDefault();
            var formData = new FormData();
            formData.append('leaveType', $('#leaveType').val());
            formData.append('fromDate', $('#fromDate').val());
            formData.append('fromShift', $('#fromShift').val());
            formData.append('toDate', $('#toDate').val());
            formData.append('toShift', $('#toShift').val());
            formData.append('totalDays', $('#totalDays').val());
            formData.append('reason', $('#reason').val());
            formData.append('action', 'leave_apply');

            $.ajax({
                type: "POST",
                url: "hrleave_back.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    var res = jQuery.parseJSON(response);

                    alertify.set('notifier', 'position', 'top-right');
                    if (res.status == 400) {
                        alertify.error(res.message);
                    }
                    else if (res.status == 402) {
                        alertify.warning(res.message);
                    }
                    else if (res.status == 403) {
                        alertify.error(res.message);
                    }
                    else if (res.status == 200) {
                        alertify.success(res.message);
                        resetLeaveForm('leaveForm', {
                            fromDateId: 'fromDate',
                            toDateId: 'toDate',
                            fromShiftId: 'fromShift',
                            toShiftId: 'toShift',
                            submitButtonSelector: 'button[type="submit"]',
                            calculateButtonId: 'calculateTotalDays',
                            resetButtonId: 'resetForm'
                        });
                        closeModal('applyLeave');
                        loadLeaveDetails();
                        loadLeaveTabDetails();
                    }
                    else if (res.status == 500) {
                        alertify.error(res.message);
                    }
                }
            });

        });

        //od apply
        $('#onDutyForm').submit(function (e) {
            e.preventDefault();

            var formData = new FormData();
            formData.append('ODType', $('#ODType').val());
            formData.append('fromDate', $('#fromDate2').val());
            formData.append('fromShift', $('#fromShift2').val());
            formData.append('toDate', $('#toDate2').val());
            formData.append('toShift', $('#toShift2').val());
            formData.append('totalDays', $('#totalDays2').val());
            formData.append('ODreason', $('#ODreason').val());
            var fileInput = $('#uploadFile')[0].files[0]; // Get the first file selected
            formData.append('uploadFile', fileInput); // Append the file object, not the value
            formData.append('action', 'OD_apply');

            // Submit form using AJAX
            $.ajax({
                url: 'hrleave_back.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    const result = JSON.parse(response);
                    alertify.set('notifier', 'position', 'top-right');
                    switch (result.status) {
                        case 200:
                            alertify.success(result.message);
                            //$('#onDutyForm')[0].reset();
                            resetLeaveForm('onDutyForm', {
                                fromDateId: 'fromDate2',
                                toDateId: 'toDate2',
                                fromShiftId: 'fromShift2',
                                toShiftId: 'toShift2',
                                submitButtonSelector: '.od_submit-btn',
                                calculateButtonId: 'calculateBtn',
                                resetButtonId: 'resetBtn'
                            });
                            closeModal('applyOD');
                            loadLeaveDetails();
                            loadODTabDetails();
                            break;

                        case 402:
                            alertify.error('Insufficient leave balance: ' + result.message);
                            break;

                        case 403:
                            alertify.error('Permission conflict: ' + result.message);
                            break;

                        default:
                            alertify.error('Error: ' + result.message);
                    }
                },
                error: function () {
                    alert('Error submitting form. Please try again.');
                }
            });
        });


        //permission apply
        $(document).on('submit', '#permissionForm', function (e) {
            e.preventDefault();
            var formData = new FormData();
            formData.append('permissionType', $('#permissionType').val());
            formData.append('permissionDate', $('#permissionDate').val());
            formData.append('preason', $('#preason').val());
            formData.append('action', 'permission_apply');

            $.ajax({
                type: "POST",
                url: "hrleave_back.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    var res = jQuery.parseJSON(response);

                    alertify.set('notifier', 'position', 'top-right');
                    if (res.status == 400) {
                        alertify.error(res.message);
                    }
                    else if (res.status == 402) {
                        alertify.warning(res.message);
                    }
                    else if (res.status == 403) {
                        alertify.error(res.message);
                    }
                    else if (res.status == 200) {
                        alertify.success(res.message);

                        closeModal('applyPermission');
                        loadLeaveDetails();
                        loadPERTabDetails();
                    }
                    else if (res.status == 500) {
                        alertify.error(res.message);
                    }
                }
            });

        });

        //COL apply
        $(document).on('submit', '#colForm', function (e) {
            e.preventDefault();
            var formData = new FormData();
            formData.append('fromDate3', $('#fromDate3').val());
            formData.append('colreason', $('#colreason').val());
            formData.append('action', 'COL_apply');

            $.ajax({
                type: "POST",
                url: "hrleave_back.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    var res = jQuery.parseJSON(response);

                    alertify.set('notifier', 'position', 'top-right');
                    if (res.status == 401) {
                        alertify.error(res.message);
                    }
                    else if (res.status == 200) {
                        alertify.success(res.message);

                        closeModal('requestCOL');
                        loadLeaveDetails();
                        loadCOLTabDetails();
                    }
                    else if (res.status == 500) {
                        alertify.error(res.message);
                    }
                }
            });

        });

        //ROD apply
        $('#RodForm').submit(function (e) {
            e.preventDefault();

            var formData = new FormData();
            formData.append('fromDate', $('#fromDate4').val());
            formData.append('fromShift', $('#fromShift4').val());
            formData.append('toDate', $('#toDate4').val());
            formData.append('toShift', $('#toShift4').val());
            formData.append('totalDays', $('#totalDays4').val());
            formData.append('ODRreason', $('#ODRreason').val());
            var fileInput = $('#uploadODRFile')[0].files[0]; // Get the first file selected
            formData.append('uploadFile', fileInput); // Append the file object, not the value
            formData.append('action', 'ODR_apply');

            // Submit form using AJAX
            $.ajax({
                url: 'hrleave_back.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    const result = JSON.parse(response);
                    alertify.set('notifier', 'position', 'top-right');
                    switch (result.status) {
                        case 200:
                            alertify.success(result.message);
                            //$('#onDutyForm')[0].reset();
                            resetLeaveForm('RodForm', {
                                fromDateId: 'fromDate4',
                                toDateId: 'toDate4',
                                fromShiftId: 'fromShift4',
                                toShiftId: 'toShift4',
                                submitButtonSelector: '.odr_submit-btn',
                                calculateButtonId: 'calculateODRBtn',
                                resetButtonId: 'resetODRBtn'
                            });
                            closeModal('requestOD');
                            loadLeaveDetails();
                            loadRODTabDetails();
                            break;

                        case 402:
                            alertify.error('Insufficient leave balance: ' + result.message);
                            break;

                        case 403:
                            alertify.error('Permission conflict: ' + result.message);
                            break;

                        default:
                            alertify.error('Error: ' + result.message);
                    }
                },
                error: function () {
                    alert('Error submitting form. Please try again.');
                }
            });
        });

    </script>
</body>