<?php
include "includes/connection.php";

if (isset($_GET['resend'])) {
    $userMail_verification = mysqli_real_escape_string($connection, $_GET['resend']);

    $Mail_verification_checher = "SELECT * FROM tbl_register WHERE Mail_verification = '{$userMail_verification}'";
    $Mail_verification_checher_result = mysqli_query($connection, $Mail_verification_checher);

    if (mysqli_num_rows($Mail_verification_checher_result) == 1) {

        $codeFetch = mysqli_fetch_assoc($Mail_verification_checher_result);
        $code = $codeFetch['Mail_verification'];
        $First_name = $codeFetch['First_name'];
        $Last_name = $codeFetch['Last_name'];
        $E_mail = $codeFetch['E_mail'];
        $Mail_verification_URL  =   "https://mrchemistry.lk/verify.php?code=" . $code;

        $to =   $E_mail;
        $sender =   'mrchemistry.palliyaguru@gmail.com';
        $email_subject  =   "Verify E-mail Address.";
        $email_body =   '<p>Dear ' . $First_name . " " . $Last_name . '</p>';
        $email_body .=   "<p>Thank you for signing up at Mr.ChemistrY! We're thrilled to have you as a new member of our community. To ensure the security of your account and to access all the features, we kindly request you to verify your email address.</p><br>";
        $email_body .=   "<p>Please follow the steps below to complete the verification process:</p><br>";
        $email_body .=   "Step 1: Click on the following link or copy-paste it into your web browser: <br>";
        $email_body .=   $Mail_verification_URL;
        $email_body .=   "<br><br>";
        $email_body .=   "Step 2: You will be directed to a verification page. If the link doesn't work, try copying and pasting it into your browser's address bar directly. <br><br>";
        $email_body .=   "Step 3: Once on the verification page, you will be prompted to log in to your Mr.ChemistrY account (if you haven't already). After logging in, your email address will be successfully verified. <br><br>";
        $email_body .=   "If you have any issues with the verification process or if you didn't create an account on Mr.ChemistrY, please ignore this email. Rest assured that your information is safe and secure. <br><br>";
        $email_body .=   "For any questions or assistance, don't hesitate to contact our support team at" . " " . "designer@ayeshmantha.lk" . "<br><br>";
        $email_body .=   "Thank you again for joining us! We look forward to providing you with an exceptional experience on Mr.ChemistrY.<br><br>";
        $email_body .=   "Best regards,<br><br>";
        $email_body .=   "The Mr.ChemistrY Team";

        $header =   "From: {$sender}\r\nContent-type: text/html;";

        $status = mail($to, $email_subject, $email_body, $header);

        if ($status) {
            header('location:register.php?verify=check_your_email_address');
        } else {
            header('location:register.php?verify=check_your_email_address');
        }
    }
}
