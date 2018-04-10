
Moja pierwsza aplikacja z wykorzystaniem wzorca MVC na podstawie szkieletu:
https://github.com/panique  
https://github.com/panique/php-mvc  
https://github.com/ivandinizaj/php-mvc


Oprogramowanie:

Lokalnie środowisko to xampp. Katalog docelowy jest synchronizowany za pomocą github desktop z kontem na githubie. 
edytor - sublime text. 
Struktura aplikacji.

Model:
- SteamAPISearchReadModel : modoel do odczytywania danych z api steam. 
- DataSearchReadModel : model odczytujacy z bazy zapisane dane.
- DataSearchWriteModel : model zapisujący w bazie dane. zazwyczaj są to dane poborane z API steam (powinny być też przetworzone do jakiejś ustalonej struktury danych aby zuniwersalizować zapis danych w bazie)

Dostępne moduły:

Search in DB - wyszukiwanie w bazie danych juz zapisanych informacji o uzytkownikach i grach.
Search in API - uzyskiwanie informacji poprzez API STEAM. Niestety w API STEAM nie znalazłem metod wyszukujacych urzytkowników czy tez gry po nazwach, tylko po ID.


