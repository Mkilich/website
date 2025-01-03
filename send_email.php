<?php
// PHP'nin hata raporlaması aktif olsun
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Form verilerini almak
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // E-posta ayarları
    $to = "kilic.klcmehmet@gmail.com";  // E-posta alıcısı
    $headers = "From: " . $email . "\r\n" . "Reply-To: " . $email . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // E-posta içeriği
    $email_subject = "Yeni İletişim Formu: " . $subject;
    $email_body = "
        <html>
        <head>
            <title>Yeni İletişim Formu</title>
        </head>
        <body>
            <p><strong>Adı:</strong> $name</p>
            <p><strong>E-posta:</strong> $email</p>
            <p><strong>Mesaj:</strong> $message</p>
        </body>
        </html>
    ";

    // E-posta gönderme işlemi
    if (mail($to, $email_subject, $email_body, $headers)) {
        echo json_encode(["message" => "Mesajınız başarıyla gönderildi."]);
    } else {
        echo json_encode(["message" => "Mesaj gönderilirken bir hata oluştu."]);
    }
}
?>
