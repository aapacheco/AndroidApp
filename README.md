# AndroidApp
 This Android app uses Java, PHP and AWS to communicate with an Arduino microcontroller that controls a solenoid to act as a locking mechanism for a door lock. The app handles user authentication and communicates with the Arduino to lock/unlock the door.

## Installation
To use this app, you'll need to follow these steps:

1. Clone this repository to your local machine.
2. Install Android Studio and the required dependencies.
3. Open the project in Android Studio and build the app.
4. Upload the PHP files in the "server" folder to a PHP-enabled web server.
5. Set up the AWS IoT Core service and configure the MQTT topics and credentials in the app code and the Arduino sketch.
6. Upload the Arduino sketch to the microcontroller.

## Usage
To use the app, follow these steps:

1. Launch the app and create an account or log in with your existing credentials.
2. Enter your credentials and click the "Log in" button.
3. The app will send your credentials to the PHP script on the server, which will validate them against a database.
4. If your credentials are valid, the app will send an MQTT message to the Arduino to unlock the door.
5. The Arduino will receive the message and activate the solenoid to unlock the door.
6. When you're done using the door, press the "Lock" button in the app to lock the door again.
7. The app will send another MQTT message to the Arduino to lock the door.

## Technologies Used
This app uses the following technologies:

* Java for the Android app code
* PHP for the server-side authentication script
* AWS IoT Core for the MQTT messaging service
* Arduino microcontroller with a solenoid to control the door lock

## Credits
This app and all code was created by Anthony Pacheco. If you have any questions or issues with the app, please contact me at aapacheco94@gmail.com.
