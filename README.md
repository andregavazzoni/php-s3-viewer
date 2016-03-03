# PHP S3 Viewer
A simple S3 browser

# Installation
  ```sh
  git clone git@github.com:andregavazzoni/php-s3-viewer.git
  ```
  
  ```sh
  composer install
  ```  
# Configuration
  We use Amazon SDK for PHP, so, you need to use one of the methods described [here](https://docs.aws.amazon.com/aws-sdk-php/v3/guide/guide/credentials.html) to load your credentials.

  If you use Hardcoded Credentials, just edit src/AmazonS3/AmazonS3.php
  
  More info: https://docs.aws.amazon.com/aws-sdk-php/v3/guide/guide/credentials.html
    
# Run
  ```sh
    php -S localhost:8081 -t web
  ```
  
Or, you can deploy it on Heroku