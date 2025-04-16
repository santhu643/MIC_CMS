<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department Selection Form</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #4895ef;
            --background: #f8f9fa;
            --text-color: #2b2d42;
        }

        body {
            background: linear-gradient(135deg, #f6f8ff 0%, #f1f4ff 100%);
            min-height: 100vh;
            padding: 50px 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .form-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(67, 97, 238, 0.1),
                        0 5px 15px rgba(0, 0, 0, 0.05);
            padding: 40px;
            max-width: 800px;
            margin: 0 auto;
            transform: translateY(0);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .form-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(67, 97, 238, 0.15),
                        0 5px 15px rgba(0, 0, 0, 0.07);
        }
        
        .form-title {
            color: var(--text-color);
            margin-bottom: 40px;
            text-align: center;
            font-weight: 700;
            font-size: 2.5rem;
            position: relative;
            padding-bottom: 15px;
        }
        
        .form-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
            border-radius: 2px;
        }
        
        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 15px;
            transition: all 0.3s ease;
            font-size: 1.1rem;
            background-color: #fff;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
            outline: none;
        }
        
        label {
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 12px;
            font-size: 1.1rem;
            display: block;
            transition: color 0.3s ease;
        }
        
        .form-group:hover label {
            color: var(--primary-color);
        }
        
        select.form-control {
            height: 60px;
            cursor: pointer;
            background-image: linear-gradient(45deg, transparent 50%, var(--primary-color) 50%),
                            linear-gradient(135deg, var(--primary-color) 50%, transparent 50%);
            background-position: calc(100% - 20px) calc(1em + 10px),
                               calc(100% - 15px) calc(1em + 10px);
            background-size: 5px 5px,
                           5px 5px;
            background-repeat: no-repeat;
            padding-right: 40px;
        }
        
        select.form-control:hover {
            border-color: var(--primary-color);
        }
        
        .required-field::after {
            content: " *";
            color: #dc3545;
            font-size: 1.2em;
        }
        
        /* Custom animation for options */
        select.form-control option {
            padding: 15px;
        }
        
        /* Card effect for department options */
        .dept-option {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
        
        .dept-option:hover {
            border-color: var(--primary-color);
            transform: translateX(5px);
        }

        /* Loading animation */
        .loading {
            position: relative;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .loading::after {
            content: '';
            width: 40px;
            height: 40px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid var(--primary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Alert styling */
        .alert {
            border-radius: 12px;
            padding: 20px;
            margin-top: 20px;
            border: none;
            background: linear-gradient(135deg, #ff9a9e 0%, #fad0c4 99%, #fad0c4 100%);
            color: #fff;
            font-weight: 500;
        }

        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .form-container {
                margin: 20px;
                padding: 30px;
            }
            
            .form-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="form-container animate__animated animate__fadeIn">
            <form id="aprofile" class="needs-validation" novalidate>
                <div class="form-group mb-4" id="deptt">
                    <label for="dept" class="required-field">Department</label>
                    <select class="form-control animate__animated animate__fadeIn" name="dept" id="dept">
                        <option value="">Choose your department</option>
                        <option value="Artificial Intelligence and Data Science">🤖 Artificial Intelligence and Data Science</option>
                        <option value="Artificial Intelligence and Machine Learning">🧠 Artificial Intelligence and Machine Learning</option>
                        <option value="Civil Engineering">🏗️ Civil Engineering</option>
                        <option value="Computer Science and Business Systems">💻 Computer Science and Business Systems</option>
                        <option value="Computer Science and Engineering">⚡ Computer Science and Engineering</option>
                        <option value="Electrical and Electronics Engineering">⚡ Electrical and Electronics Engineering</option>
                        <option value="Electronics Engineering (VLSI Design)">🔌 Electronics Engineering (VLSI Design)</option>
                        <option value="Electronics and Communication Engineering">📡 Electronics and Communication Engineering</option>
                        <option value="Information Technology">💾 Information Technology</option>
                        <option value="Mechanical Engineering">⚙️ Mechanical Engineering</option>
                        <option value="Freshman Engineering">🎓 Freshman Engineering</option>
                        <option value="Master of Business Administration">💼 Master of Business Administration</option>
                        <option value="Master of Computer Applications">🖥️ Master of Computer Applications</option>
                    </select>
                </div>

                <div class="mb-3" id="kalai">
                    <!-- Dynamic content will be loaded here -->
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Add animation class when page loads
            setTimeout(function() {
                $('.form-container').addClass('animate__fadeIn');
            }, 100);

            // Form validation
            (function() {
                'use strict';
                window.addEventListener('load', function() {
                    var forms = document.getElementsByClassName('needs-validation');
                    var validation = Array.prototype.filter.call(forms, function(form) {
                        form.addEventListener('submit', function(event) {
                            if (form.checkValidity() === false) {
                                event.preventDefault();
                                event.stopPropagation();
                            }
                            form.classList.add('was-validated');
                        }, false);
                    });
                }, false);
            })();

            // Department change handler with loading animation
            $("#dept").change(function() {
                var dept = $(this).val();
                if (dept) {
                    // Show loading animation
                    $("#kalai").html('<div class="loading"></div>');
                    
                    $.ajax({
                        url: "pcode.php",
                        method: "POST",
                        data: {
                            'sel_std1': true,
                            adept: dept
                        },
                        success: function(response) {
                            // Fade out loading, then show response
                            $("#kalai").fadeOut(200, function() {
                                $(this).html(response).fadeIn(200);
                            });
                        },
                        error: function() {
                            $("#kalai").fadeOut(200, function() {
                                $(this).html('<div class="alert">Unable to load department data. Please try again.</div>').fadeIn(200);
                            });
                        }
                    });
                } else {
                    $("#kalai").html('');
                }
            });

            // Add hover animation to select
            $("#dept").hover(
                function() {
                    $(this).addClass('animate__pulse');
                },
                function() {
                    $(this).removeClass('animate__pulse');
                }
            );
        });
    </script>
</body>
</html>