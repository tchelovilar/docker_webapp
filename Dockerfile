FROM tchelovilar/nginx-phpfpm-redis-session

RUN rm -rf /var/www/html/*
COPY src/  /var/www/html/

EXPOSE 80
CMD ["/start.sh"]
