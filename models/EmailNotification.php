<?php
require __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class EmailNotification {
    private $mailer;
    private $config;
    private $conn;
    
    public function __construct($db) {
        try {
            $this->config = require __DIR__ . '/../config/mail_config.php';
            $this->conn = $db;
            $this->initializeMailer();
        } catch (Exception $e) {
            error_log("EmailNotification constructor error: " . $e->getMessage());
            throw $e;
        }
    }
    
    private function initializeMailer() {
        try {
            $this->mailer = new PHPMailer(true);
            
            // Enable debug output
            $this->mailer->SMTPDebug = SMTP::DEBUG_SERVER;
            $this->mailer->Debugoutput = function($str, $level) {
                error_log("SMTP Debug: $str");
            };
            
            $this->mailer->isSMTP();
            $this->mailer->Host = $this->config['smtp_host'];
            $this->mailer->SMTPAuth = true;
            $this->mailer->Username = $this->config['smtp_username'];
            $this->mailer->Password = $this->config['smtp_password'];
            $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->mailer->Port = $this->config['smtp_port'];
            
            $this->mailer->setFrom(
                $this->config['from_email'],
                $this->config['from_name']
            );
        } catch (Exception $e) {
            error_log("Mailer initialization error: " . $e->getMessage());
            throw $e;
        }
    }
    
    public function sendLoginNotification($userId) {
        try {
            // Get user details
            $query = "SELECT firstname, lastname, email, role FROM users WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$userId]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$user) {
                error_log("User not found for ID: " . $userId);
                return false;
            }
            
            $this->mailer->clearAddresses();
            $this->mailer->addAddress($user['email']);
            $this->mailer->isHTML(true);
            
            $this->mailer->Subject = 'New Login to Your Storm Q Account';
            $this->mailer->Body = $this->getLoginEmailTemplate($user);
            
            $success = $this->mailer->send();
            
            if ($success) {
                // Record notification
                $query = "INSERT INTO login_notifications (user_id, login_time, notification_sent) 
                         VALUES (?, NOW(), 1)";
                $stmt = $this->conn->prepare($query);
                $stmt->execute([$userId]);
            }
            
            return $success;
        } catch (Exception $e) {
            error_log("Email sending failed: " . $e->getMessage());
            return false;
        }
    }

    // Add this missing method
    private function getLoginEmailTemplate($user) {
        $currentTime = date('Y-m-d H:i:s');
        $roleText = ucfirst($user['role']);
        
        return "
            <html>
            <body style='font-family: Arial, sans-serif;'>
                <div style='max-width: 600px; margin: 0 auto; padding: 20px;'>
                    <h2>Welcome Back, {$user['firstname']} {$user['lastname']}!</h2>
                    <p>We noticed a new login to your StormQ account ({$roleText}) on {$currentTime}.</p>
                    <p>If this wasn't you, please contact support immediately.</p>
                    <br>
                    <p style='color: #666;'>
                        Best regards,<br>
                        Storm Q Team
                    </p>
                </div>
            </body>
            </html>
        ";
    }
}