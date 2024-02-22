# Urls

React:
```
https://github.com/dittelh/react-docker
```

Wordpress url:
```
http://localhost:8000/wp-admin/index.php
```

Wordpress api url:
```
http://localhost:8000/wp-json/wp/v2/posts
```

Database url:
```
http://localhost:8080/
```

React url:
```
http://localhost:3000/
```

# Docker commands

Build react:
```
docker build -t react-docker .
```

Run react:
```
docker run -p 3000:3000 react-docker
```

Start wordpress in background (obs be in ~wordpress folder)
```
docker compose up -d
```
