# WeatherPlug - Dokumentacja aplikacji

## Opis

WeatherPlug jest aplikacją służącą do odbierania zapytań REST API od stacji meteorologicznych oraz zapisywania danych otrzymanych z tych zapytań do bazy danych. Aplikacja obsługuje zapytania w kształcie "jajek", które zawierają informacje o różnych parametrach meteorologicznych.

## Cechy aplikacji

1. **Odbieranie danych z stacji meteorologicznych**: Aplikacja umożliwia odbieranie zapytań REST API wysyłanych przez stacje meteorologiczne w formie "jajek" zawierających informacje o parametrach meteorologicznych.

2. **Zapisywanie danych w bazie danych**: Otrzymane dane z stacji meteorologicznych są zapisywane w bazie danych w celu dalszej analizy i wykorzystania.

3. **Tworzenie wykresów temperatur i wilgotności**: Aplikacja oferuje funkcjonalność generowania wykresów na podstawie zgromadzonych danych, umożliwiających wizualizację temperatury i wilgotności w różnych okresach czasu.

4. **Możliwość zarządzania "jajkami"**: Użytkownicy mają możliwość zarządzania otrzymanymi "jajkami" poprzez przeglądanie, edycję i usuwanie zgromadzonych danych.

5. **Przypisywanie do użytkowników**: Aplikacja umożliwia przypisywanie otrzymanych danych meteorologicznych do konkretnych użytkowników, co pozwala na lepsze zarządzanie danymi i ich dostępnością.

6. **Integracja z innymi systemami**: WeatherPlug może być łatwo zintegrowany z innymi systemami do analizy danych meteorologicznych lub raportowania.

7. **Bezpieczeństwo danych**: Aplikacja zapewnia odpowiednie mechanizmy bezpieczeństwa w celu ochrony danych meteorologicznych oraz danych użytkowników.

## Wymagania systemowe

- Język programowania: PHP
- Baza danych: MySQL lub PostgreSQL
- Framework do obsługi zapytań REST API: Laravel
- Biblioteki do generowania wykresów
- System operacyjny: Wsparcie dla systemów Windows, Linux i macOS

## Instalacja i konfiguracja

1. Sklonuj repozytorium WeatherPlug z GitHuba.
2. Zainstaluj wymagane zależności, wykonując polecenie `git clone https://github.com/mindgoner/WeatherPlug.git`.
3. Zainstaluj projekt poleceniem `composer install`.
4. Zainstaluj zależności poleceniem `npm install && npm run build`
4. Skonfiguruj połączenie z bazą danych w pliku konfiguracyjnym.
5. Wygeneruj klucz poleceniem `php artisan key:generate`
6. Uruchom aplikację za pomocą polecenia `php artisan serve`.
7. Aplikacja będzie dostępna pod adresem http://localhost:5000/.

## Autorzy

WeatherPlug został stworzony przez zespół deweloperski składający się z:
- Dominik Zając
- Bartosz Bieniek

## Licencja

WeatherPlug jest dostępny na licencji MIT. Szczegółowe informacje o licencji (będzie) można (kiedyś) znaleźć w pliku LICENSE.
