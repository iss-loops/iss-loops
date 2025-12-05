FROM nginx:stable-alpine

# Copiar configuración personalizada
COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf

# Crear directorio de logs
RUN mkdir -p /var/log/nginx

EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]