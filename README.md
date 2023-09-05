# Utilisation

- Créer une DB en local avec le nom 'agel'
- Modifier les éléments du .env pour que l'appli accède à la DB
- Faire un 'php artisan serve'
- aller sur localhost:8000/login
- Ajouter dans la DB manuellement un user admin : 
  - password à mettre (équivaut à 'president') : $2y$10$3SyfwPir/euMS2n6jnZY1uZYTgBtQCovpkvJ/Sb6Rp2aDvIO86lre
  - droit à mettre pour admin : 1


# Idées de départ - Egon
## Plateforme
- Site web en single-page (inventaire-agel.be)
- Framework simple (react, angular, ASP)
- Scalable
- Indépendant
## Fonctionnalités
- Homescreen sous forme d’un choix de connection : Bureau AGEL ou Membre d’un comité.
- Panneau d’administration : modification des encodages, des inputs pour un inventaire, corrections,des données par défaut, …
- Calendrier des événements (ajout, modification, suppression), lecture disponible pour les visiteurs (avec l’heure de l’inventaire d’entrée et de sortie et le nom du membre du bureau en charge). Mise à jour automatique sur le google calendar du bureau.
- Page Contact avec les différents numéros en cas de soucis (Pompes, inondations, électricité, membres du Bureau, pompiers, etc).
- Statistiques sur l’entièreté des événements.
- Système d’encodage manuel d’un événement (ancienne donnée, etc).
- Déclaration d’un événement interactif (liste des événement sous forme d’une listeview avec modification et génération de lien pour les admins only).
- Génération et envoi automatique de l’inventaire et de la facture.
- Système de plainte pour un événement.
- Génération des événements de l’année pour l’assurance (récapitulatif obligatoire).
- Page contenant une cheatsheet pour les comités en fonction de l’événement (par exemple pour une Saint le déroulement typique, avec les heures, les must have, lien vers un BEP, etc).
- Demander une location (autre onglet), par exemple sono AGEL, BBQ agel, char à la Saint-Torè, etc.
- Facturation automatique aux comités
- État d’un événement :
  - À venir
  - Inventaire d’entrée
  - Données manquantes (typiquement les noms des sécu’ TEC).
  - En cours
  - Inventaire de sortie
  - Terminé
  - Facturé
  - Litige
  - Payé
- Reset des données des comptes comités (en septembre par exemple pour avoir les nouveaux e-mails).
- Système de location de la salle (avec calendrier et date disponible)
## Utilisation
- Création d’une session (déclaration d’un événement)
- Utilisateurs
- Membre de l’AGEL (host).
- Membre du comité entrant (obligatoire à l’entrée, sauf si pas de GSM mais validation avec signature nécessaire)
- Membre du comité sortant (obligatoire à la sortie, sauf si pas de GSM mais validation avec signature nécessaire)
- Anonyme (lecture only).
- Ouverture (inventaire d’entrée)
- Création d’une session par un admin (génération d’un lien).
- Lien envoyé à un comité qui entre leurs informations (voir contrat AGEL).
- Les données sont celles du dernier événement en date.
- Lecture du contrat avec un “J’approuve”.
- Points importants dans le style d’un tutorial screen (par exemple le parking voiture, les ponctions MEL, etc).
- Début de session avec feedback en live pour le comité.
- Validation de chaque point par les deux parties.
- Signature.
- Fermeture (inventaire de sortie)
- Création d’une session par un admin (génération d’un lien).
- Lien envoyé à un comité.
- Vérification et validation des points (nuisances sonores, propretés des alentours, autres amendes).
- Début de session avec feedback en live pour le comité.
- Signature.
## Features
- Pièce jointe (carte d’identité, photos, preuves, etc).
- Signature digitale (voir le coté légal).
