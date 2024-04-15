FROM ubuntu

RUN apt update

RUN apt install -y software-properties-common

RUN ln -s /usr/share/zoneinfo/Asia/Almaty /etc/localtime && \
  echo "Asia/Almaty" > /etc/timezone

RUN apt update

RUN apt install -y wget vim less

RUN apt -y install php php-curl php-dom php-zip php-mysql php-fpm php-mbstring php-gd php-memcached php-fpm

RUN wget https://getcomposer.org/download/2.7.1/composer.phar

RUN chmod +x composer.phar
RUN mv composer.phar /usr/local/bin/composer

RUN apt install -y nginx webp

WORKDIR /app

COPY . .

COPY ./nginx.conf /etc/nginx/sites-available/default

ENTRYPOINT ["bash", "./entry-point.sh"]
