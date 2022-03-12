## Komenda do pobiernia danych pogodowych

```
php bin/console api:get-weather
```

Argumenty wymagane:
* city - miasto z którego chcemy pobrać dane pogodowe
* country - państwo z którego chcemy pobrać dane pogodowe

Argumenty opcjonalne:
* provider - dostawca danych pogodowych(domyślny OpenWeather/)

## Endpointy
### Pobierania tokenu JWT
1. POST `/api/api/login_check` z argumentami `username` oraz `password`

### Bez autoryzacji JWT
1. GET `/api/article` - endpoint listujący wszystkie artykuły
2. GET `/api/article/id` - endpointy pobierający dane konkretnego artukuły za pomocą *id*

### Z autoryzacją JWT
1. GET `/api/user` - endpoint pobierający liste uzytkowników w systemie
2. GET `/api/weather` - endpoint pobierający dane pogodowe. Argumenty dodatkowe `city` oraz `country`.
np. `/api/weather?city=Bydgoszcz&country=PL`