<?php

    namespace Classes;
    use Instances\InstanceConnection;
    use Classes\PHPMail;
    use PDO;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    class PHPMail{

        private $data;
        private $host;
        private $username;
        private $password;
        private $port;
        public $sender;
        public $recipient;
        public $obj_mail;

        public function __construct($mail_config = array()){

            $this->data = $mail_config['message_data'];
            $this->host = $mail_config['host'];
            $this->username = $mail_config['username'];
            $this->password = $mail_config['password'];
            $this->port = $mail_config['port'];
            $this->sender = $mail_config['email_sender'];
            $this->recipient = $mail_config['email_recipient'];

        }

        public function mailsetConfig(){

            $mail = $this->getmailerInstance();

            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;               //Enable verbose debug output
            $mail->isSMTP();                                     //Send using SMTP
            $mail->Host       = $this->host;                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                            //Enable SMTP authentication
            $mail->Username   = $this->username;                 //SMTP username
            $mail->Password   = $this->password;                 //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  //Enable implicit TLS encryption
            $mail->Port       = $this->port;                     //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            $mail->CharSet = 'UTF-8';

            //Remetente
            $mail->setFrom($this->sender);
            
            //Destinatário
            $mail->addAddress($this->recipient);     
        
            //Content
            $mail->isHTML(true);                               
            $mail->Subject = $this->data['subject'];
            $mail->Body    = $this->data['body'];
            $mail->AltBody = $this->data['altbody'];
            
            $this->obj_mail = $mail;


        }

        public function sentEmail(){

            try {

                $this->obj_mail->send();

                return true;

            }catch (Exception $e) {
                //echo $e;

                return false;

            }

        }

        private function getmailerInstance(){

            return new PHPMailer(true);

        }


    }

