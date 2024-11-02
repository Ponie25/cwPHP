<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP-Web-main/vendor/autoload.php';
include $_SERVER['DOCUMENT_ROOT'] . '/PHP-Web-main/PHP/session_start.php';

// Variables
$server_email = ""; // Your Gmail address here
$server_password = ""; // Your Gmail app-specific password here
$adminEmail = 'silkyy2507@gmail.com';






// Handle form submission
$messageSent = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_SESSION['username']; // Get name from session
    $email = trim($_POST['email']); // User's email from form
    $subject = trim($_POST['subject']);
    $messageContent = trim($_POST['message']);

    // Validate form fields
    if (!empty($name) && !empty($email) && !empty($subject) && !empty($messageContent)) {
        // Initialize SwiftMailer with Gmail's SMTP settings
        $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
            ->setUsername($server_email) 
            ->setPassword($server_password); 

        $mailer = new Swift_Mailer($transport);

        // Compose the email message
        $message = (new Swift_Message($subject))
            ->setFrom([$email => $name])
            ->setTo([$adminEmail => 'Admin'])
            ->setBody("Name: $name\n$messageContent");

        // Send the email
        try {
            $mailer->send($message);
            $messageSent = true;
        } catch (Exception $e) {
            $error = "Message could not be sent. Error: " . $e->getMessage();
        }
    } else {
        $error = "Please fill in all fields.";
    }
}
ob_start()
?>
<section class="">
    <div class="max-w-md mx-auto mt-10 bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Contact Admin</h2>

        <?php if ($messageSent): ?>
            <p class="text-green-500">Your message has been sent successfully!</p>
        <?php else: ?>
            <?php if (!empty($error)): ?>
                <p class="text-red-500"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <form action="contact.php" method="post">
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium">Email</label>
                    <input type="email" id="email" name="email" class="w-full p-2 border rounded" required>
                </div>
                <div class="mb-4">
                    <label for="subject" class="block text-sm font-medium">Subject</label>
                    <input type="text" id="subject" name="subject" class="w-full p-2 border rounded" required>
                </div>
                <div class="mb-4">
                    <label for="message" class="block text-sm font-medium">Message</label>
                    <textarea id="message" name="message" rows="4" class="w-full p-2 border rounded" required></textarea>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Send Message</button>
            </form>
        <?php endif; ?>
    </div>
</section>
</html>
<?php
$content = ob_get_clean();
include '../Template/layout.html.php'; ?>
