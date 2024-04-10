FROM nginx:1.21-alpine

COPY nginx.conf  /etc/nginx/
COPY templates /etc/nginx/templates/
RUN echo "upstream users-upstream { server users_service:9000; }" > /etc/nginx/conf.d/users_upstream.conf
RUN echo "upstream notifications-upstream { server notifications_service:9002; }" > /etc/nginx/conf.d/notifications_upstream.conf

EXPOSE 80
EXPOSE 443
