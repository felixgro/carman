## Rider

Mit Rider behält man allzeit den Überblick über jegliche verkehrsbezogenen Ausgaben, vergangene Fahrten und verpflichtende Notwendigkeiten, wie den TÜV-Check beispielsweise.

### Notwendige Schritte um Prototypen zu sehen (MAC OS):

- Repository Klonen
`git clone https://github.com/felixgro/rider.git`

- Ins geklonte Respository navigieren
`cd rider/`

- Die Datei .env.example zu .env umbenennen und die korrekten Zugangsdaten für die Datenbank eingeben. Der Datenbankname ist beliebig , der Typ muss jedoch utf8mb4_general_ci sein. Die Datenbank muss manuell erstellt werden, darf jedoch keine Tabellen enthalten.

- Alle Composer Dependencies instrallieren
`composer install`

- Alle NPM Dependencies instrallieren
`npm i`

- Alle Sass/Js Datein konvertieren
`npm run dev`

- Einen App-Key generieren
`php artisan key:generate`

- Die im .env Datenbanktabelle migrieren
`php artisan migrate`

- Die Tabellen mit generierten Daten befüllen
`php artisan db:seed`

- Den von Laravel integrierten Live Server starten
`php artisan serve`

Die Login Daten, die bei der Migration erstellt wurden lauten "admin@admin.com" mit dem Passwort "secret"
