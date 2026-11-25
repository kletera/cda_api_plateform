### instructions
### 1 Créer les 2 clés
```sh
mkdir config/jwt

openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096

openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout
```
Ajouter dans `.env.dev`
```dotenv
JWT_SECRET_KEY=%kernel.project_dir%/config/jwt/private.pem
JWT_PUBLIC_KEY=%kernel.project_dir%/config/jwt/public.pem
JWT_PASSPHRASE=
```