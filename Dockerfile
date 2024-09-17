# Sử dụng PHP image chính thức
FROM php:8.0-apache

# Cài đặt các tiện ích mở rộng cần thiết (nếu có)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Sao chép toàn bộ nội dung vào thư mục làm việc trong container
COPY . /var/www/html/

# Expose port 80
EXPOSE 80
