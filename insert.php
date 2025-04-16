<?php
$servername = "localhost";
$username = "TIHMIC";
$password = "KalaI@@1992@@";
$dbname = "biodata";

$conn = new mysqli($servername, $username, $password, $dbname);
function getCurrentDate()
{
    return date('d/m/Y');
}
$response = array("status" => "", "message" => "");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$post_applied_for = $_POST['post_applied_for'];
$department = $_POST['department'];
$name = $_POST['name'];
$dob = $_POST['dob'];
$phone = $_POST['phone']; // Phone number to be used as photo file name
$email = $_POST['email'];
$father_name = $_POST['father_name'];
$mother_name = $_POST['mother_name'];
$family_status = $_POST['family_status'];
$father_occupation = $_POST['father_occupation'];
$mother_occupation = $_POST['mother_occupation'];
$siblings_occupation = $_POST['siblings_occupation'];
$permanent_address = $_POST['permanent_address'];
$religion = $_POST['religion'];
$community = $_POST['community'];
$caste = $_POST['caste'];
$marital_status = $_POST['marital_status'];
$spouse_name = $_POST['spouse_name'];
$spouse_qualification = $_POST['spouse_qualification'];
$spouse_occupation = $_POST['spouse_occupation'];
$children_info = $_POST['children_info'];
$children_age = $_POST['children_age'];

$x_std_specialization = $_POST['x_std_specialization'];
$x_std_institution = $_POST['x_std_institution'];
$x_std_place = $_POST['x_std_place'];
$x_std_year = $_POST['x_std_year'];
$x_std_percentage = $_POST['x_std_percentage'];
$x_std_class_obtained = $_POST['x_std_class_obtained'];

$xii_std_specialization = $_POST['xii_std_specialization'];
$xii_std_institution = $_POST['xii_std_institution'];
$xii_std_place = $_POST['xii_std_place'];
$xii_std_year = $_POST['xii_std_year'];
$xii_std_percentage = $_POST['xii_std_percentage'];
$xii_std_class_obtained = $_POST['xii_std_class_obtained'];

$diploma_specialization = $_POST['diploma_specialization'];
$diploma_institution = $_POST['diploma_institution'];
$diploma_place = $_POST['diploma_place'];
$diploma_year = $_POST['diploma_year'];
$diploma_percentage = $_POST['diploma_percentage'];
$diploma_class_obtained = $_POST['diploma_class_obtained'];

$ug_specialization = $_POST['ug_specialization'];
$ug_institution = $_POST['ug_institution'];
$ug_place = $_POST['ug_place'];
$ug_year = $_POST['ug_year'];
$ug_percentage = $_POST['ug_percentage'];
$ug_class_obtained = $_POST['ug_class_obtained'];

$pg_specialization = $_POST['pg_specialization'];
$pg_institution = $_POST['pg_institution'];
$pg_place = $_POST['pg_place'];
$pg_year = $_POST['pg_year'];
$pg_percentage = $_POST['pg_percentage'];
$pg_class_obtained = $_POST['pg_class_obtained'];

$mphil_specialization = $_POST['mphil_specialization'];
$mphil_institution = $_POST['mphil_institution'];
$mphil_place = $_POST['mphil_place'];
$mphil_year = $_POST['mphil_year'];
$mphil_percentage = $_POST['mphil_percentage'];
$mphil_class_obtained = $_POST['mphil_class_obtained'];

$phd_specialization = $_POST['phd_specialization'];
$phd_institution = $_POST['phd_institution'];
$phd_place = $_POST['phd_place'];
$phd_year = $_POST['phd_year'];
$phd_percentage = $_POST['phd_percentage'];
$phd_class_obtained = $_POST['phd_class_obtained'];

$additional_qualification = $_POST['additional_qualification'];
$ug_experience = $_POST['ug_experience'];
$pg_experience = $_POST['pg_experience'];
$phd_experience = $_POST['phd_experience'];
$industry_experience = $_POST['industry_experience'];
$total_experience = $_POST['total_experience'];
$salary_expected = $_POST['salary_expected'];
$last_salary = $_POST['lastsalary'];
$photo_file_path = $_FILES['photo_file_path']['name'];

$upload_dir = 'photo/';
$photo_filename = $phone . '.' . pathinfo($_FILES['photo_file_path']['name'], PATHINFO_EXTENSION);
$upload_file = $upload_dir . basename($photo_filename);

$applicationDate = getCurrentDate();

if (move_uploaded_file($_FILES['photo_file_path']['tmp_name'], $upload_file)) {
    $sql = "INSERT INTO applicant_data (post_applied_for, department, name, dob, phone, email, father_name, mother_name, family_status, father_occupation, mother_occupation, siblings_occupation, permanent_address, religion, community, caste, marital_status, spouse_name, spouse_qualification, spouse_occupation, children_info, children_age, x_std_specialization, x_std_institution, x_std_place, x_std_year, x_std_percentage,x_std_class_obtained,xii_std_specialization,xii_std_institution, xii_std_place, xii_std_year, xii_std_percentage,xii_std_class_obtained, diploma_specialization,diploma_institution, diploma_place, diploma_year, diploma_percentage,diploma_class_obtained, ug_specialization, ug_institution, ug_place, ug_year, ug_percentage,ug_class_obtained,pg_specialization, pg_institution, pg_place, pg_year, pg_percentage,pg_class_obtained,mphil_specialization, mphil_institution, mphil_place, mphil_year, mphil_percentage,mphil_class_obtained,phd_specialization, phd_institution, phd_place, phd_year, phd_percentage,phd_class_obtained, additional_qualification, ug_experience, pg_experience, phd_experience, industry_experience,total_experience, salary_expected,last_salary, photo_file_path,application_date ) VALUES ('$post_applied_for', '$department', '$name', '$dob', '$phone', '$email', '$father_name', '$mother_name', '$family_status', '$father_occupation', '$mother_occupation', '$siblings_occupation', '$permanent_address', '$religion', '$community', '$caste', '$marital_status', '$spouse_name', '$spouse_qualification', '$spouse_occupation', '$children_info', '$children_age','$x_std_specialization','$x_std_institution', '$x_std_place', '$x_std_year', '$x_std_percentage','$x_std_class_obtained', '$xii_std_specialization','$xii_std_institution', '$xii_std_place', '$xii_std_year', '$xii_std_percentage','$xii_std_class_obtained', '$diploma_specialization','$diploma_institution', '$diploma_place', '$diploma_year', '$diploma_percentage','$diploma_class_obtained','$ug_specialization','$ug_institution', '$ug_place', '$ug_year', '$ug_percentage','$ug_class_obtained','$pg_specialization', '$pg_institution', '$pg_place', '$pg_year', '$pg_percentage','$pg_class_obtained', '$mphil_specialization', '$mphil_institution', '$mphil_place', '$mphil_year', '$mphil_percentage', '$mphil_class_obtained','$phd_specialization', '$phd_institution', '$phd_place', '$phd_year', '$phd_percentage','$phd_class_obtained', '$additional_qualification', '$ug_experience', '$pg_experience', '$phd_experience','$industry_experience', '$total_experience', '$salary_expected', '$last_salary', '$photo_filename','$applicationDate')";

    if ($conn->query($sql) === TRUE) {
        $response['status'] = "success";
        $response['message'] = "Application submitted successfully!";
    } else {
        $response['status'] = "error";
        $response['message'] = "Submission failed. Please reach out to the HR department for assistance.";
    }
} else {
    $response['status'] = "error";
    $response['message'] = "Sorry, there was an error uploading your file.";
}

echo json_encode($response);
$conn->close();
