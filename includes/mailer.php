<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once ROOT_PATH . '/vendor/phpmailer/PHPMailer.php';
require_once ROOT_PATH . '/vendor/phpmailer/SMTP.php';
require_once ROOT_PATH . '/vendor/phpmailer/Exception.php';

/**
 * Send email using PHPMailer or fallback to PHP mail()
 * 
 * @param string $to Recipient email
 * @param string $subject Email subject
 * @param string $body HTML email body
 * @param string $altBody Plain text alternative body
 * @return bool Success status
 */
function sendEmail($to, $subject, $body, $altBody = '') {
    // Check if SMTP is configured
    $smtp_configured = (SMTP_USER !== 'your-email@gmail.com' && SMTP_PASS !== 'your-app-password');
    
    if ($smtp_configured) {
        // Use PHPMailer with SMTP
        $mail = new PHPMailer(true);
        
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = SMTP_HOST;
            $mail->SMTPAuth = true;
            $mail->Username = SMTP_USER;
            $mail->Password = SMTP_PASS;
            $mail->SMTPSecure = SMTP_ENCRYPTION;
            $mail->Port = SMTP_PORT;
            
            // Recipients
            $mail->setFrom(SMTP_FROM, SMTP_FROM_NAME);
            $mail->addAddress($to);
            
            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->AltBody = $altBody ?: strip_tags($body);
            
            $mail->send();
            return true;
            
        } catch (Exception $e) {
            error_log("PHPMailer failed: {$mail->ErrorInfo}, trying fallback...");
            // Fall through to PHP mail()
        }
    }
    
    // Fallback to PHP mail()
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "From: " . SMTP_FROM_NAME . " <" . SMTP_FROM . ">\r\n";
    $headers .= "Reply-To: " . SMTP_FROM . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();
    
    $success = @mail($to, $subject, $body, $headers);
    
    if (!$success) {
        error_log("PHP mail() failed for: $to");
    }
    
    return $success;
}
?>
