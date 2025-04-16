<?php
include 'db_connection.php';

// Get the applicant ID from the query parameter
$applicant_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($applicant_id > 0) {
  // Prepare and execute the SQL statement to fetch applicant data
  $sql = "SELECT * FROM applicant_data WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $applicant_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $applicant = $result->fetch_assoc();
  $stmt->close();
} else {
  die("No applicant ID provided");
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Bio-Data Application Form - <?php echo htmlspecialchars($applicant['name']); ?></title>
  <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f0f0f0;
    }

    .container {
      max-width: 800px;
      margin: 20px auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    header {
      display: flex;
      align-items: center;
      border-bottom: 2px solid black;
      padding-bottom: 20px;
      margin-bottom: 20px;
    }

    header .logo img,
    header .logo2 img {
      height: 100px;
      margin-right: 20px;
    }

    header .logo2 img {
      width: 50px;
      height: auto;
      margin-left: 40px;
    }

    header .college-info {
      text-align: center;
      flex: 1;
    }

    header .college-info h1 {
      margin: 0;
      font-size: 1.5em;
    }

    header .college-info p {
      margin: 5px 0 0;
      font-size: 0.9em;
    }

    .form-heading {
      text-align: center;
      font-size: 1.2em;
      margin-bottom: 20px;
      font-weight: bold;
      text-transform: uppercase;
    }

    .profile {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      margin-bottom: 20px;
    }

    .profile-details {
      flex: 1;
    }

    .profile img {
      width: 150px;
      height: auto;
      border-radius: 8px;
      margin-left: 20px;
      margin-top: 20px;
    }

    .profile .name {
      margin-top: 10px;
      text-align: center;
    }

    .profile .name h2 {
      margin: 0;
      font-size: 1.2em;
      background-color: #ffc107;
      padding: 10px;
      border-radius: 4px;
      display: inline-block;
    }

    .contact-info table {
      width: 100%;
      margin-top: 20px;
      border-collapse: collapse;
    }

    .contact-info table,
    .contact-info th,
    .contact-info td {
      border: 1px solid black;
      padding: 10px;
    }

    .contact-info th {
      background-color: #f8f8f8;
      text-align: left;
    }

    .contact-info td i {
      margin-right: 10px;
      color: #ffc107;
    }

    .additional-info table {
      width: 100%;
      border-collapse: collapse;
      table-layout: fixed;
      /* Ensure equal column widths */
    }

    .additional-info th,
    .additional-info td {
      border: 1px solid black;
      padding: 10px;
      vertical-align: top;
      width: 25%;
      /* Equal column widths */
      word-wrap: break-word;
      /* Handle long content */
    }

    .additional-info th {
      background-color: #f8f8f8;
      text-align: left;
    }

    .additional-info .spouse-details th,
    .additional-info .spouse-details td {
      border: none;
      padding: 5px;
      width: auto;
      /* Equal column widths within nested table */
    }

    .section-heading {
      font-size: 1.2em;
      margin-top: 20px;
      margin-bottom: 10px;
      font-weight: bold;
      text-transform: uppercase;
    }

    .qualification-info,
    .terms-conditions {
      margin-top: 20px;
    }

    .terms-conditions ul {
      list-style-type: disc;
      margin: 0;
      padding-left: 20px;
    }

    .terms-conditions li {
      margin-bottom: 10px;
    }

    h4 {
      text-align: center;
      /* Center-align the entire heading */
      font-size: 1.2em;
      /* Adjust the font size as needed */
      margin: 5px 0;
      /* Margin around the heading */
    }

    h4 .name {
      display: inline-block;
      /* Ensure the border surrounds only the name */
      padding: 5px 10px;
      /* Space inside the border */
      border: 2px solid #ffc107;
      /* Stylish border color and width */
      border-radius: 5px;
      /* Rounded corners for the border */
      background-color: #fff;
      /* Background color to make the border stand out */
      font-weight: bold;
      /* Optional: Make the name bold */
      color: #333;
      /* Text color for contrast */
    }

    h4 i {
      color: #ffc107;
      /* Color for the icon */
      margin-right: 10px;
      /* Space between the icon and text */
    }

    .dashed-hr {
      border: none;
      border-top: 2px dashed #000;
      /* Adjust color and thickness as needed */
      margin: 20px 0;
      /* Adjust margin as needed */
    }

    .personal-info-header {
  background-color: #1e3799 !important;
  color: white !important;
  padding: 12px !important;
  text-align: left !important;
  border: 1px solid black !important;
}


    @media print {
      body {
        font-size: 12pt;
      }

      .container {
        padding: 10px;
      }

      header {
        padding-bottom: 10px;
        margin-bottom: 10px;
      }

      .form-heading {
        margin-bottom: 10px;
      }

      .profile img {
        width: 120px;
      }

      .section-heading {
        margin-top: 10px;
        margin-bottom: 5px;
      }

      table {
        margin-top: 10px;
        border: 1px;
        border-color: black;
      }
      .personal-info-header {

  color: black !important;

}
      th{
        background-color:black;
        color:black;
      }
      td {
        padding: 6px;
        color:black;

      }

      .form-container {
        border: none;
        box-shadow: none;
        page-break-inside: avoid;
      }

      .qualification-info {
        page-break-before: always;
      }

      button {
        display: none;
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <header>
      <div class="logo">
        <img src="img/mkcelogo.jpg" alt="College Logo" />
      </div>
      <div class="college-info">
        <h1>M.KUMARASAMY COLLEGE OF ENGINEERING</h1>
        <p>
          NAAC Accredited Autonomous Institution<br />
          Approved by AICTE & Affiliated to Anna University<br />
          Thalavapalayam, Karur-639 113, Tamilnadu.
        </p>
      </div>
      <div class="logo2">
        <img src="img/kr.jpg" alt="College Logo" />
      </div>
    </header>
    <div class="form-heading">
      Application for Staff Recruitment
    </div>
    <h4>
      <i class="fas fa-user-circle"></i> Name:
      <span class="name"><?php echo htmlspecialchars($applicant['name']); ?></span>
    </h4>
    <table style="
          width: 100%;
          border-collapse: collapse;
          font-family: Arial, sans-serif;
          font-size: 14px;
          margin-top: 20px;
          border: 1px solid black;
        ">
      <tr>
        <th style="
              border: 1px solid black;
              padding: 8px;
              background-color: #f4f4f4;
              text-align: left;
            ">
          <i class="fas fa-briefcase"></i> Post Applied
        </th>
        <td style="border: 1px solid black; padding: 8px; text-align: left">
          <?php echo htmlspecialchars($applicant['post_applied_for']); ?>
        </td>
        <th style="
              border: 1px solid black;
              padding: 8px;
              background-color: #f4f4f4;
              text-align: left;
            ">
          <i class="fas fa-building"></i> Department
        </th>
        <td style="border: 1px solid black; padding: 8px; text-align: left">
          <?php echo htmlspecialchars($applicant['department']); ?>
        </td>
      </tr>
    </table>

    <div class="profile">
      <div class="profile-details">
        <div class="contact-info">
          <table style="font-family: Arial, sans-serif; font-size: 15px">
            <tr>
            <th class="personal-info-header" colspan="5">Personal Informations</th>
            </tr>

            <tr>
              <th><i class="fas fa-birthday-cake"></i> D.O.B</th>
              <td> <?php
                    $date = new DateTime($applicant['dob']);
                    echo $date->format('d-m-Y');
                    ?></td>
              <th><i class="fas fa-phone"></i> Phone</th>
              <td><?php echo htmlspecialchars($applicant['phone']); ?></td>
            </tr>
            <tr>
              <th><i class="fas fa-envelope"></i> Email</th>
              <td><?php echo htmlspecialchars($applicant['email']); ?></td>
              <th><i class="fas fa-user"></i> Father's Name</th>
              <td><?php echo htmlspecialchars($applicant['father_name']); ?></td>
            </tr>
            <tr>
              <th><i class="fas fa-user"></i> Mother's Name</th>
              <td><?php echo htmlspecialchars($applicant['mother_name']); ?></td>
              <th><i class="fas fa-users"></i> No. of Brothers & Sisters:</th>
              <td>2</td>
            </tr>
          </table>
        </div>
      </div>
      <div class="profile-pic">
        <img src="photo/<?php echo htmlspecialchars($applicant['photo_file_path']); ?>" alt="Applicant Photo">
      </div>
    </div>

    <div class="additional-info">
      <table style="font-family: Arial, sans-serif; font-size: 14px">
        <tr>
          <th>Father's Occupation</th>
          <td> <?php echo htmlspecialchars($applicant['father_occupation']); ?></td>
          <th>Mother's Occupation</th>
          <td><?php echo htmlspecialchars($applicant['mother_occupation']); ?></td>
        </tr>
        <tr>
          <th>Brothers / Sisters Occupation</th>
          <td> <?php echo htmlspecialchars($applicant['siblings_occupation']); ?></td>
          <th>Permanent Address</th>
          <td>
            <?php echo nl2br(htmlspecialchars($applicant['permanent_address'])); ?>
          </td>
        </tr>
        <tr>
          <th>Religion</th>
          <td><?php echo htmlspecialchars($applicant['religion']); ?></td>
          <th>Community</th>
          <td><?php echo htmlspecialchars($applicant['community']); ?></td>
        </tr>
        <tr>
          <th>Caste/Sub Caste</th>
          <td><?php echo htmlspecialchars($applicant['caste']); ?></td>
          <th>Marital Status</th>
          <td><?php echo htmlspecialchars($applicant['marital_status']); ?></td>
        </tr>
        <tr>
          <th>If Married, details of spouse</th>
          <td colspan="3">
            <table class="spouse-details" style="
                  width: 100%;
                  border-collapse: collapse;
                  font-family: Arial, sans-serif;
                  font-size: 14px;
                ">
              <tr>
                <th style="
                      border: 1px solid black;
                      padding: 8px;
                      background-color: #f8f8f8;
                      text-align: left;
                    ">
                  Name
                </th>
                <td colspan="3" style="
                      border: 1px solid black;
                      padding: 8px;
                      text-align: left;
                    ">
                  <?php echo htmlspecialchars($applicant['spouse_name']); ?>
                </td>
              </tr>
              <tr>
                <th style="
                      border: 1px solid black;
                      padding: 8px;
                      background-color: #f8f8f8;
                      text-align: left;
                    ">
                  Occupation
                </th>
                <td style="
                      border: 1px solid black;
                      padding: 8px;
                      text-align: left;
                    ">
                  <?php echo htmlspecialchars($applicant['spouse_occupation']); ?>
                </td>

                <th style="
                      border: 1px solid black;
                      padding: 8px;
                      background-color: #f8f8f8;
                      text-align: left;
                    ">
                  Qualification
                </th>
                <td style="
                      border: 1px solid black;
                      padding: 8px;
                      text-align: left;
                    ">
                 <?php echo htmlspecialchars($applicant['spouse_qualification']); ?>
                </td>
              </tr>
              <tr>
                <th style="
                      border: 1px solid black;
                      padding: 8px;
                      background-color: #f8f8f8;
                      text-align: left;
                    ">
                  No. of Children
                </th>
                <td style="
                      border: 1px solid black;
                      padding: 8px;
                      text-align: left;
                    ">
                  <?php echo htmlspecialchars($applicant['children_info']); ?>
                </td>
                <th style="
                      border: 1px solid black;
                      padding: 8px;
                      background-color: #f8f8f8;
                      text-align: left;
                    ">
                  Children's age
                </th>
                <td style="
                      border: 1px solid black;
                      padding: 8px;
                      text-align: left;
                    ">
                  <?php echo htmlspecialchars($applicant['children_age']); ?>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </div>

    <table style="
          width: 100%;
          border-collapse: collapse;
          font-family: Arial, sans-serif;
          font-size: 14px;
          margin-top: 20px;
        ">
      <tr>
      <th class="personal-info-header" colspan="5">
          Experience After
        </th>
      </tr>
      <tr>
        <td style="padding: 12px; border: 1px solid black; width: 20%;text-align:center;">
          <strong>UG:</strong> <?php echo htmlspecialchars($applicant['ug_experience']); ?>
        </td>
        <td style="padding: 12px; border: 1px solid black; width: 20%;text-align:center;">
          <strong>PG:</strong> <?php echo htmlspecialchars($applicant['pg_experience']); ?>
        </td>
        <td style="padding: 12px; border: 1px solid black; width: 20%;text-align:center;">
          <strong>PhD:</strong> <?php echo htmlspecialchars($applicant['phd_experience']); ?>
        </td>
        <td style="padding: 12px; border: 1px solid black; width: 40%;text-align:center;">
          <strong>Total:</strong> <?php echo htmlspecialchars($applicant['total_experience']); ?>
          <strong>Industy:</strong> <?php echo htmlspecialchars($applicant['industry_experience']); ?>
        </td>
      </tr>
    </table>

    <div class="qualification-info">
      <!-- <div class="section-heading">Educational Qualifications</div> -->
      <table style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif; font-size: 14px; border: 1px solid black;">

        <thead>
          <tr>
          <th class="personal-info-header" colspan="7">
              Educational Qualifications
            </th>
          </tr>
          <tr style="background-color: #073b46; color: white;">
            <th style="padding: 12px; text-align: left; border: 1px solid black; text-align:center;">Details</th>
            <th style="padding: 12px; text-align: left; border: 1px solid black; text-align:center;">Specialisation</th>
            <th style="padding: 12px; text-align: left; border: 1px solid black; text-align:center;">Institution</th>
            <th style="padding: 12px; text-align: left; border: 1px solid black; text-align:center;">Place</th>
            <th style="padding: 12px; text-align: left; border: 1px solid black; text-align:center;">Year of Passing</th>
            <th style="padding: 12px; text-align: left; border: 1px solid black; text-align:center;">% of Marks</th>
            <th style="padding: 12px; text-align: left; border: 1px solid black; text-align:center;">Class</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($applicant['x_std_institution']) && !empty($applicant['x_std_year'])) : ?>
            <tr style="background-color: #f2f2f2;">
              <td style="padding: 12px; border: 1px solid black; text-align:center;">X Std</td>
              <td style="padding: 12px; border: 1px solid black; text-align:center;"><?php echo htmlspecialchars($applicant['x_std_specialization']); ?></td>
              <td style="padding: 12px; border: 1px solid black; text-align:center;"><?php echo htmlspecialchars($applicant['x_std_institution']); ?></td>
              <td style="padding: 12px; border: 1px solid black; text-align:center;"><?php echo htmlspecialchars($applicant['x_std_place']); ?></td>
              <td style="padding: 12px; border: 1px solid black; text-align:center;"><?php echo htmlspecialchars($applicant['x_std_year']); ?></td>
              <td style="padding: 12px; border: 1px solid black; text-align:center;"><?php echo htmlspecialchars($applicant['x_std_percentage']); ?></td>
              <td style="padding: 12px; border: 1px solid black; text-align:center;"><?php echo htmlspecialchars($applicant['x_std_class_obtained']); ?></td>
            </tr>
          <?php endif; ?>

          <?php if (!empty($applicant['xii_std_institution']) && !empty($applicant['xii_std_year'])) : ?>
            <tr>
              <td style="padding: 12px; border: 1px solid black; text-align:center;">XII Std</td>
              <td style="padding: 12px; border: 1px solid black; text-align:center;"><?php echo htmlspecialchars($applicant['xii_std_specialization']); ?></td>
              <td style="padding: 12px; border: 1px solid black; text-align:center;"><?php echo htmlspecialchars($applicant['xii_std_institution']); ?></td>
              <td style="padding: 12px; border: 1px solid black; text-align:center;"><?php echo htmlspecialchars($applicant['xii_std_place']); ?></td>
              <td style="padding: 12px; border: 1px solid black; text-align:center;"><?php echo htmlspecialchars($applicant['xii_std_year']); ?></td>
              <td style="padding: 12px; border: 1px solid black; text-align:center;"><?php echo htmlspecialchars($applicant['xii_std_percentage']); ?></td>
              <td style="padding: 12px; border: 1px solid black; text-align:center;"><?php echo htmlspecialchars($applicant['xii_std_class_obtained']); ?></td>
            </tr>
          <?php endif; ?>

          <?php if (!empty($applicant['diploma_institution']) && !empty($applicant['diploma_year'])) : ?>
            <tr style="background-color: #f2f2f2;">
              <td style="padding: 12px; border: 1px solid black; text-align:center;">Diploma</td>
              <td style="padding: 12px; border: 1px solid black; text-align:center;"><?php echo htmlspecialchars($applicant['diploma_specialization']); ?></td>
              <td style="padding: 12px; border: 1px solid black; text-align:center;"><?php echo htmlspecialchars($applicant['diploma_institution']); ?></td>
              <td style="padding: 12px; border: 1px solid black; text-align:center;"><?php echo htmlspecialchars($applicant['diploma_place']); ?></td>
              <td style="padding: 12px; border: 1px solid black; text-align:center;"><?php echo htmlspecialchars($applicant['diploma_year']); ?></td>
              <td style="padding: 12px; border: 1px solid black; text-align:center;"><?php echo htmlspecialchars($applicant['diploma_percentage']); ?></td>
              <td style="padding: 12px; border: 1px solid black; text-align:center;"><?php echo htmlspecialchars($applicant['diploma_class_obtained']); ?></td>
            </tr>
          <?php endif; ?>

          <?php if (!empty($applicant['ug_institution']) && !empty($applicant['ug_year'])) : ?>
            <tr>
              <td style="padding: 12px; border: 1px solid black; text-align:center;">UG</td>
              <td style="padding: 12px; border: 1px solid black; text-align:center;"><?php echo htmlspecialchars($applicant['ug_specialization']); ?></td>
              <td style="padding: 12px; border: 1px solid black; text-align:center;"><?php echo htmlspecialchars($applicant['ug_institution']); ?></td>
              <td style="padding: 12px; border: 1px solid black; text-align:center;"><?php echo htmlspecialchars($applicant['ug_place']); ?></td>
              <td style="padding: 12px; border: 1px solid black; text-align:center;"><?php echo htmlspecialchars($applicant['ug_year']); ?></td>
              <td style="padding: 12px; border: 1px solid black; text-align:center;"><?php echo htmlspecialchars($applicant['ug_percentage']); ?></td>
              <td style="padding: 12px; border: 1px solid black; text-align:center;"><?php echo htmlspecialchars($applicant['ug_class_obtained']); ?></td>
            </tr>
          <?php endif; ?>

          <?php if (!empty($applicant['pg_institution']) && !empty($applicant['pg_year'])) : ?>
            <tr style="background-color: #f2f2f2;">
              <td style="padding: 12px; border: 1px solid black; text-align:center;">PG</td>
              <td style="padding: 12px; border: 1px solid black; text-align:center;"><?php echo htmlspecialchars($applicant['pg_specialization']); ?></td>
              <td style="padding: 12px; border: 1px solid black; text-align:center;"><?php echo htmlspecialchars($applicant['pg_institution']); ?></td>
              <td style="padding: 12px; border: 1px solid black; text-align:center;"><?php echo htmlspecialchars($applicant['pg_place']); ?></td>
              <td style="padding: 12px; border: 1px solid black; text-align:center;"><?php echo htmlspecialchars($applicant['pg_year']); ?></td>
              <td style="padding: 12px; border: 1px solid black; text-align:center;"><?php echo htmlspecialchars($applicant['pg_percentage']); ?></td>
              <td style="padding: 12px; border: 1px solid black; text-align:center;"><?php echo htmlspecialchars($applicant['pg_class_obtained']); ?></td>
            </tr>
          <?php endif; ?>

          <?php if (!empty($applicant['mphil_institution']) && !empty($applicant['mphil_year'])) : ?>
            <tr>
              <td style="padding: 12px; border: 1px solid black; text-align:center;">M.Phil</td>
              <td style="padding: 12px; border: 1px solid black; text-align:center;"><?php echo htmlspecialchars($applicant['mphil_specialization']); ?></td>
              <td style="padding: 12px; border: 1px solid black; text-align:center;"><?php echo htmlspecialchars($applicant['mphil_institution']); ?></td>
              <td style="padding: 12px; border: 1px solid black; text-align:center;"><?php echo htmlspecialchars($applicant['mphil_place']); ?></td>
              <td style="padding: 12px; border: 1px solid black; text-align:center;"><?php echo htmlspecialchars($applicant['mphil_year']); ?></td>
              <td style="padding: 12px; border: 1px solid black; text-align:center;"><?php echo htmlspecialchars($applicant['mphil_percentage']); ?></td>
              <td style="padding: 12px; border: 1px solid black; text-align:center;"><?php echo htmlspecialchars($applicant['mphil_class_obtained']); ?></td>
            </tr>
          <?php endif; ?>

          <?php if (!empty($applicant['phd_institution']) && !empty($applicant['phd_year'])) : ?>
            <tr style="background-color: #f2f2f2;">
              <td style="padding: 12px; border: 1px solid black; text-align:center;">Ph.D</td>
              <td style="padding: 12px; border: 1px solid black; text-align:center;"><?php echo htmlspecialchars($applicant['phd_specialization']); ?></td>
              <td style="padding: 12px; border: 1px solid black; text-align:center;"><?php echo htmlspecialchars($applicant['phd_institution']); ?></td>
              <td style="padding: 12px; border: 1px solid black; text-align:center;"><?php echo htmlspecialchars($applicant['phd_place']); ?></td>
              <td style="padding: 12px; border: 1px solid black; text-align:center;"><?php echo htmlspecialchars($applicant['phd_year']); ?></td>
              <td style="padding: 12px; border: 1px solid black; text-align:center;"><?php echo htmlspecialchars($applicant['phd_percentage']); ?></td>
              <td style="padding: 12px; border: 1px solid black; text-align:center;"><?php echo htmlspecialchars($applicant['phd_class_obtained']); ?></td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
    <!-- <table style="
          width: 100%;
          border-collapse: collapse;
          font-family: Arial, sans-serif;
          font-size: 14px;
          margin-top: 20px;
        ">
      <tr>
      <th class="personal-info-header" colspan="5">
          Additional Qualifications
        </th>
      </tr>
      <tr>
        <td style="padding: 12px; border: 1px solid black">
          <ul style="margin: 0; padding-left: 20px">
            <li style="margin-bottom: 5px">
              <?php echo htmlspecialchars($applicant['additional_qualification']); ?>
            </li>
          </ul>
        </td>
      </tr>
    </table> -->


    <table style="
          width: 100%;
          border-collapse: collapse;
          font-family: Arial, sans-serif;
          font-size: 14px;
          margin-top: 20px;
        ">
      <tr>
      <th class="personal-info-header" style="width:25%;">
          Additional Qualifications
        </th>
        <td style="padding: 12px; border: 1px solid black">
        <?php echo htmlspecialchars($applicant['additional_qualification']); ?>
        </td>
      </tr>

    </table>






    <table style="
          width: 100%;
          border-collapse: collapse;
          font-family: Arial, sans-serif;
          font-size: 14px;
          margin-top: 20px;
        ">
<tr>
  <th class="personal-info-header" style="
      
        color: black;
        padding: 12px;
        text-align: left;
        border: 1px solid black;
        width: 25%;
      ">
    Last Salary Drawn
  </th>
  <th style="
       
        color: black;
        padding: 12px;
        text-align: center;
        border: 1px solid black;
        width: 25%;
      ">
         <?php echo '₹' . htmlspecialchars($applicant['last_salary']); ?>
  </th>
  <th class="personal-info-header" style="
     
        color: black;
        padding: 12px;
        text-align: left;
        border: 1px solid black;
        width: 25%;
      ">
   Salary Expected
  </th>
  <th style="
       
        color: black;
        padding: 12px;
        text-align: center;
        border: 1px solid black;
        width: 25%;
      ">
   <?php
  if (empty($applicant['salary_expected']) || $applicant['salary_expected'] == 0) {
    echo 'As per Norms';
  } else {
    echo '₹' . htmlspecialchars($applicant['salary_expected']);
  }
?>

  </th>
</tr>
    </table>

    <table style="
          width: 100%;
          border-collapse: collapse;
          font-family: Arial, sans-serif;
          font-size: 14px;
          margin-top: 20px;
        ">
      <tr>
        <th class="personal-info-header" colspan="2">
          Terms and Conditions
        </th>
      </tr>
      <tr>
        <td style="padding: 12px; border: 1px solid black; vertical-align: top">
          <ul style="margin: 0; padding-left: 20px">
            <?php if (empty($applicant['phd_institution']) && empty($applicant['phd_year'])) : ?>
              <li style="margin-bottom: 10px">
                Minimum one patent to be filed every year and Minimum two papers are to be published every year in SCOPUS
                Indexed Journals.
              </li>

              <li style="margin-bottom: 10px">
                Faculty member can get relieved at the end of an academic year with three month notice after completion of 2 years of service in the college.
              </li>


              <li style="margin-bottom: 10px">
                If you resign in the middle of the academic year, you have to pay 3 months' salary.
              </li>
            <?php endif; ?>
            <?php if (!empty($applicant['phd_institution']) && !empty($applicant['phd_year'])) : ?>
              <li style="margin-bottom: 10px">
                Minimum one patent to be filed every year and Minimum two papers are to be published every year in SCI/SCIE Indexed Journals.
              </li>

              <li style="margin-bottom: 10px">
                Faculty member can get relieved at the end of an academic year with three month notice after completion of 2 years of service in the college.
              </li>
              <li style="margin-bottom: 10px">
                If you resign in the middle of the academic year, you have to pay 3 months' salary.
              </li>
              <li style="margin-bottom: 10px">
                Minimum three proposals seeking financial assistance are to be submitted every year to funding agencies, and at least one of the proposals shall be taken to the level of presentation.
              </li>

              <li>
                A revenue of ₹50,000 shall be generated through consultancy if no funding proposal reaches the level of presentation.
              </li>

            <?php endif; ?>

          </ul>
        </td>
      </tr>
    </table>
    <table style="
          width: 100%;
          border-collapse: collapse;
          font-family: Arial, sans-serif;
          font-size: 14px;
          margin-top: 20px;
        ">
      <!-- <tr>
          <th
            style="
              background-color: #1e3799;
              color: white;
              padding: 12px;
              text-align: left;
              border: 1px solid black;
            "
          >
            Date & Signature
          </th>
        </tr> -->
      <tr>
        <td style="padding: 12px; border: 1px solid black">
          <span style="margin-right: 20px"><strong>Date:</strong> <?php echo htmlspecialchars($applicant['application_date']); ?></span>
          <span style="margin-left: 240px"><strong>Signature of the Candidate:</strong>
          </span>
        </td>
      </tr>
    </table>

    <hr class="dashed-hr">
    <p style="text-align: center">For office use only</p>
    <div style="text-align: center; margin-top: 20px">
      <button onclick="window.print()" style="
          padding: 10px 20px;
          font-size: 16px;
          background-color: #1e3799;
          color: white;
          border: none;
          border-radius: 5px;
          cursor: pointer;
        ">
        Print as PDF
      </button>
    </div>
  </div>
</body>

<script>
  function printForm() {
    window.print();
  }
</script>

</html>