<!DOCTYPE html>
<html>

<head>

    <style>
        .form-group {
            margin-bottom: 20px;
        }

        .timer {
            font-size: 1.2rem;
            font-weight: bold;
            color: #dc3545;
        }

        .seat-locked {
            color: #856404;
            background-color: #fff3cd;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .booking-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 1600px;
            margin: 0 auto;
        }

        .form-group label {
            font-weight: 600;
            color: #495057;
        }

        .form-control {
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
            border-color: #80bdff;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .form-header {
            text-align: center;
            margin-bottom: 30px;
            color: #343a40;
        }

        .form-header h2 {
            font-weight: 700;
        }

        .custom-select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 5'%3E%3Cpath fill='%23343a40' d='M2 0L0 2h4zm0 5L0 3h4z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right .75rem center;
            background-size: 8px 10px;
        }

        .text-muted {
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
    <div class="container-fluid">

        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Terms and Conditions</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <ul style="text-align: justify;">
                            <li>Students who wish to use the college bus service must log in to their MIC Portal
                                (<a href="https://mic.mkce.ac.in">mic.mkce.ac.in</a>) and book their seats.
                                Please ensure your basic details (Reg no, Name, Dept, etc.) are verified in the
                                MIC Portal before proceeding with the booking.</li>
                            <li>Students must ensure their basic profile is 100% complete before attempting to
                                book.</li>
                            <li>Booking requires filling out an application form and completing an online
                                payment process.</li>
                            <li>Students must complete the entire booking process, including payment, within 15
                                minutes. If the booking process exceeds this time limit, it will be
                                automatically terminated, and the institution will not be responsible for any
                                payment losses incurred.</li>
                            <li>Upon completing the payment, students will be allotted a bus and a seat number.
                            </li>
                            <li>The booking is valid until 21.12.2024. After this date, students must renew
                                their bus allotment within 10 days to retain their seats. Failure to renew will
                                result in automatic seat cancellation of the allotment.</li>
                            <li>Students must wear their ID and keep the bus allotment order, as it may be
                                verified at any time.</li>
                            <li>Payments are to be made on a semester-wise basis for all students. Registration
                                cannot be cancelled mid-academic year. Students applying for the bus service
                                mid-semester must pay the full amount.</li>
                            <li>Partial payment is not acceptable for transport bookings of less than a
                                semester.</li>
                            <li>Upon selecting a boarding point, bus number and seat allocation will be done by
                                default. Male students will receive seat numbers in reverse order, while female
                                students will receive them in forward order.</li>
                            <li>Payments should be made via Scan Pay/UPI/Net Banking/Cards.</li>
                            <li>Cancellations are permitted for fourth-year students in their eighth semester or
                                those who have applied for internships lasting more than a month. Cancellations
                                will be handled manually with office support.</li>
                            <li>Boarding points can be changed with prior approval from the manager, but bus
                                fees cannot be modified mid-semester. Students may occupy available seats, but
                                this cannot be guaranteed.</li>
                            <li>The number of buses and boarding points may be adjusted based on student demand.
                            </li>
                            <li>If bus seats are unavailable for booking or if you encounter any issues during
                                the booking process, please contact the office for further assistance.</li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="booking-container">
            <div class="form-header">
                <h2>Bus Booking Form</h2>
                <p class="text-muted">Please fill out the details carefully</p>
            </div>

            <form id="stoppingPointForm">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">

                            <input type="hidden" class="form-control" id="regno" name="regno" value="<?php echo $s; ?>"
                                required placeholder="Enter Registration Number">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input class="form-control" type="hidden" id="name" name="name"
                                value="<?php echo $sname; ?>" required placeholder="Enter Full Name">
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="form-group">
                        <input readonly aria-readonly="true" type="hidden" class="form-control btn-rounded" id="gender"
                            name="gender" placeholder="Enter your name" required value="<?php echo $sgender; ?>">
                    </div>

                    <div class="form-group">
                        <input readonly aria-readonly="true" type="hidden" class="form-control btn-rounded"
                            id="bookingGraduation" name="bookingGraduation" required value="<?php echo $sayear; ?>">
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="bookingYear">Year</label>
                            <select class="custom-select" id="bookingYear" required onchange="updateSemesterOptions()">
                                <option value="">Select Year</option>
                                <option value="1">1st Year</option>
                                <option value="2">2nd Year</option>
                                <option value="3">3rd Year</option>
                                <option value="4">4th Year</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="bookingSemester">Semester</label>
                            <select class="custom-select" id="bookingSemester" required>
                                <option value="">Select Semester</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">

                        <input class="form-control" type="hidden" id="bookingBranch" name="bookingBranch"
                            value="<?php echo $sdept; ?>" required>

                    </div>


                </div>


                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="bus">Select Bus</label>
                            <select class="custom-select" id="bus" name="bus_id" required>
                                <option value="">Select Bus</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="stopping_point">Stopping Point</label>
                            <select class="custom-select" id="stopping_point" name="stopping_point_id" required
                                disabled>
                                <option value="">Select Stopping Point</option>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">

                            <input type="hidden" class="form-control" id="amount" name="amount" readonly
                                placeholder="Amount will be calculated">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="termsCheckbox" required>
                                <label class="custom-control-label" for="termsCheckbox">
                                    I have read and agree to the Terms and Conditions
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary btn-lg px-5">
                        Proceed to Payment
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>

        $(document).ready(function () {
            // Initially show modal on page load
            // $("#myModal").modal('show');

            // Add event listener for terms checkbox
            $('#termsCheckbox').on('change', function () {
                if (this.checked) {
                    // If unchecked, show the modal again
                    $("#myModal").modal('show');
                }
            });

            // Ensure modal can only be closed if checkbox is checked
            $('#myModal .close, #myModal [data-dismiss="modal"]').on('click', function () {
                if ($('#termsCheckbox').is(':checked')) {
                    $('#myModal').modal('hide');
                } else {
                    // Optionally, you can show a message
                    alert('Please read and agree to the terms and conditions');
                }
            });
        });
        $(document).ready(function () {
            $("#myModal").modal('show');
        });


        function updateSemesterOptions() {
            const year = document.getElementById('bookingYear').value;
            const semesterSelect = document.getElementById('bookingSemester');

            // Clear existing options
            semesterSelect.innerHTML = '<option value="">Select Semester</option>';

            let semesters = [];
            switch (year) {
                case '1':
                    semesters = [{ value: '1', text: '1st Semester' }, { value: '2', text: '2nd Semester' }];
                    break;
                case '2':
                    semesters = [{ value: '3', text: '3rd Semester' }, { value: '4', text: '4th Semester' }];
                    break;
                case '3':
                    semesters = [{ value: '5', text: '5th Semester' }, { value: '6', text: '6th Semester' }];
                    break;
                case '4':
                    semesters = [{ value: '7', text: '7th Semester' }, { value: '8', text: '8th Semester' }];
                    break;
            }

            // Populate new semester options
            semesters.forEach(sem => {
                const option = document.createElement('option');
                option.value = sem.value;
                option.textContent = sem.text;
                semesterSelect.appendChild(option);
            });
        }

        $(document).ready(function () {
            // Load buses on page load
            loadBuses();

            // Load available buses
            function loadBuses() {
                $.ajax({
                    url: 'student_bus_back.php',
                    type: 'GET',
                    data: { action: 'get_available_buses' },
                    dataType: 'json',
                    success: function (response) {
                        if (response && Array.isArray(response)) {
                            $('#bus').html('<option value="">Select Bus</option>');
                            response.forEach(bus => {
                                $('#bus').append(`<option value="${bus.id}" data-bus-number="${bus.bus_number}">${bus.bus_number} - ${bus.route_name}</option>`);
                            });
                        } else {
                            console.error('Invalid response format:', response);
                            alert('Error loading buses. Please try again.');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Ajax error:', error);
                        alert('Error loading buses. Please try again.');
                    }
                });
            }

            // When bus is selected
            $('#bus').change(function () {
                const busId = $(this).val();
                if (busId) {
                    loadStoppingPoints(busId);
                } else {
                    $('#stopping_point').prop('disabled', true).html('<option value="">Select Stopping Point</option>');
                }
            });

            // Load stopping points for selected bus
            function loadStoppingPoints(busId) {
                $.ajax({
                    url: 'student_bus_back.php',
                    type: 'GET',
                    dataType: 'json',
                    data: { bus_id: busId, action: 'get_stopping_points' },
                    success: function (response) {
                        if (response && Array.isArray(response)) {
                            $('#stopping_point').prop('disabled', false)
                                .html('<option value="">Select Stopping Point</option>');
                            response.forEach(point => {
                                $('#stopping_point').append(
                                    `<option value="${point.id}" data-stop-name="${point.name}" data-price="${point.price}">
                                        ${point.name} - ₹${point.price}
                                    </option>`
                                );
                            });
                        } else {
                            console.error('Invalid stopping points response:', response);
                            alert('Error loading stopping points. Please try again.');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Ajax error:', error);
                        alert('Error loading stopping points. Please try again.');
                    }
                });
            }

            // Update amount when stopping point is selected
            $('#stopping_point').change(function () {
                const selectedOption = $('#stopping_point option:selected');
                if (selectedOption.length && selectedOption.data('price')) {
                    $('#amount').val(selectedOption.data('price'));
                } else {
                    $('#amount').val('');
                }
            });

            // Form submission
            $('#stoppingPointForm').submit(function (e) {
                e.preventDefault();

                const formData = {
                    regno: $('#regno').val(),
                    name: $('#name').val(),
                    gender: $('#gender').val(),

                    branch: $('#bookingBranch').val(),
                    graduation: $('#bookingGraduation').val(),
                    year: $('#bookingYear').val(),
                    semester: $('#bookingSemester').val(),

                    bus_id: $('#bus').val(),
                    bus_number: $('#bus option:selected').data('bus-number'),
                    stopping_point_id: $('#stopping_point').val(),
                    stop_name: $('#stopping_point option:selected').data('stop-name'),
                    amount: $('#amount').val()
                };

                // First check seat availability
                $.ajax({
                    url: 'student_bus_back.php',
                    type: 'POST',
                    dataType: 'json',
                    data: { formData, action: 'check_seat_availability' },
                    success: function (response) {
                        if (response.available) {
                            // Initialize Razorpay payment
                            initializePayment(formData, response.order_id);
                        }
                        else if (response.status === 1001) { // Use strict equality
                            Swal.fire({
                                icon: 'error',
                                title: 'Booking Failed',
                                text: "Already Booked Or Try again Later",
                                confirmButtonText: 'Try Again'
                            });
                        }
                        else if (response.status === 404) { // Use strict equality
                            Swal.fire({
                                icon: 'error',
                                title: 'Booking Failed',
                                text: response.message,
                                confirmButtonText: 'Try Again'
                            });
                        }
                        else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Booking Failed',
                                text: "No seats available or seat already booked. Please contact the office.",
                                confirmButtonText: 'Try Again'
                            });
                        }
                    }
                    ,
                    error: function (xhr, status, error) {
                        alert('Error checking seat availability.');
                    }
                });
            });

            function initializePayment(formData, orderId) {
                const options = {
                    key: 'rzp_test_391iEOtkV2VfwQ', // Replace with your Razorpay key
                    amount: formData.amount * 100, // Amount in paise
                    currency: 'INR',
                    name: 'Bus Booking',
                    description: 'Bus Seat Booking Payment',
                    order_id: orderId,
                    handler: function (response) {
                        // On successful payment
                        handlePaymentSuccess(response, formData);
                    },
                    prefill: {
                        name: formData.name,
                    },
                    theme: {
                        color: '#3399cc'
                    }
                };

                const rzp = new Razorpay(options);
                rzp.open();
            }

            function handlePaymentSuccess(paymentResponse, formData) {
                // Send payment verification and booking data to server
                $.ajax({
                    url: 'verify_payment_and_book.php',
                    type: 'POST',
                    data: {
                        ...formData,
                        razorpay_payment_id: paymentResponse.razorpay_payment_id,
                        razorpay_order_id: paymentResponse.razorpay_order_id,
                        razorpay_signature: paymentResponse.razorpay_signature
                    },
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Booking Successful!',
                                text: 'Your seat number is ' + response.seat_number,
                                confirmButtonText: 'View Ticket',
                                showCancelButton: true,
                                cancelButtonText: 'Close'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Redirect to ticket generation when "View Ticket" is clicked
                                    window.location.href = 'generate_pass.php?booking_id=' + encodeURIComponent(response.booking_id);
                                    $('#stoppingPointForm').trigger('reset');
                                }
                            });

                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Booking Failed',
                                text: "Already Booked",
                                confirmButtonText: 'Try Again'
                            });
                        }
                    },
                    error: function () {
                        alert('Error processing booking. Please contact support.');
                    }
                });
            }
        });



        $('#myModal .close, #myModal [data-dismiss="modal"]').on('click', function () {
            $('#myModal').modal('hide');
        });
    </script>
</body>

</html>