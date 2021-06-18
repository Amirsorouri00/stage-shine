FROM php:7.4-fpm

# Arguments defined in docker-compose.yml
ARG USER_ID=2222
ARG GROUP_ID=2222
ARG DB_DATABASE=laravel
ARG DB_PASSWORD=123123
ARG DB_USERNAME=Amirhossein
ARG user=stage_shine
RUN groupadd -g ${GROUP_ID} app
RUN useradd -u ${USER_ID} -ms /bin/bash -g app app

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    vim \
    sudo \  
    net-tools \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    bash \
    apt-utils \
    build-essential \
    openssh-client clang make bash bash-completion

RUN mkdir -p \
    /home/node/.vscode-server/extensions \
    /home/node/.vscode-server-insiders/extensions \
    /home/node/.ssh
        

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user


# Set working directory
WORKDIR /app

COPY --chown=${USER_ID}:${GROUP_ID} . /app  
COPY --chown=${USER_ID}:${GROUP_ID} . /app  
RUN chmod -R 777 /app/*
RUN chmod -R 777 /app/storage
RUN chmod -R 777 /app/storage/logs
RUN chmod -R 777 /app/storage/logs/laravel.log
RUN chmod -R 777 /app/storage/framework/

# CMD ["php artisan migrate", "php artisan passport:install"]
# CMD ["/usr/local/bin/entrypoint.sh","php-fpm","-F"]



USER $user
