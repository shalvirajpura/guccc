<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $college = $_POST['college'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $experience = $_POST['experience'];
    $goals = $_POST['goals'];
    $photoConsent = isset($_POST['photo_consent']) ? 'Yes' : 'No';
    $source = $_POST['source'];
    $wp_group = isset($_POST['wp_group']) ? 'Yes' : 'No';

    // Send email
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ceshalvi@gmail.com'; // Your Gmail address
        $mail->Password = 'gfxlixbqmnrdqadc'; // Your Gmail app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // Recipients
        $mail->setFrom('ceshalvi@gmail.com', 'GirlUp Coders');
        $mail->addAddress($email);

        // Attachments
        $mail->addAttachment('welcome.png'); // Path to the welcome image
        $mail->addAttachment('brochure.pdf'); // Path to the brochure PDF


        // Email content
        $emailBody = "
        <html>
        <body>
            <p>Dear $name,</p>
            <p>We are excited to welcome you to the GirlUp Coders Summer Cohort 1.0 - AI Edition starting from June 22. As a registered member of this cohort, you will embark on an exciting journey to explore the world of Artificial Intelligence.</p>
           
            <p>Attached, you will find more details about the cohort and a welcome image to get you started. We look forward to seeing you in the sessions!</p>
            <p>Best regards,<br>
            The GirlUp Coders Team</p>
        </body>
        </html>";

        // Send email
        $mail->isHTML(true);
        $mail->Subject = 'Welcome to GirlUp Coders Summer Cohort 1.0';
        $mail->Body    = $emailBody;
        $mail->AltBody = strip_tags($emailBody);

        $mail->send();
        echo "success";
    } catch (Exception $e) {
        echo "Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
