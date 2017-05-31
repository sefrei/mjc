# ProjectMJC

## Evolution de la Base de donnée
Un professeur peut avoir une ou plusieurs spécialité.
Un élève peut avoir un ou plusieurs souscription Ex : guitare + chant.
Seul l'administrateur enregistre les spécialités (nom), les professeurs et les élèves avec Nom, prénom, date de naissance, email, mot de passe qui sera envoyé par mail et changé par l'user à la première connexion.

Pour le premier sprint, on voudrait pouvoir afficher l'emploi du temps du jour d'un professeur avec nom de l'élève, la spécialité, et l'horaire.

Dans un deuxième temps, une autre vue qui sera le lien d'un seul cours avec une description plus complète peut-être avec des infos en plus sur l'élève, la possibilité d'annuler le cours avec un bouton, et un textarea pour donner des observations sur ce cours.

1. ![1re ébauche](/captures/ebauche.png)

2. ![schéma 1 avec entités Teacher et Student](/captures/schema_entité.png)

3. ![schéma avec attributs](/captures/schema_attributs_et_contraintes.png)

4. ![changement de cap avec une seule entité User](/captures/Entite_User.png)

## Question 1  
× Est-ce qu'avec une seule entité User, je pourrai quand même faire le lien avec l'élève et le prof via leur id ?
Je pensais faire une sélection ROLE_TEACHER et ROLE_STUDENT. Et ça serait plus simple pour les login/Logout et la sécurité....

## Question 2
× Un souscription comprends plusieurs leçons. L'admin entrais la date et l'heure du premier cours et la date et l'heure de la fin de ce premier cours avec dateTime. On pourrait alors calculer le temps du cours et enregistrer automatiquement les autres dates des cours avec DATE_ADD() + 7 DAY.
Si startAt + 7 Day < Date des vacances => new Lesson


# 24 MAI 2017
## Ce que j'ai fait
- encodage mot de passe
- enregistrement des users en bd
- enregistrement des spécialités
-

## Ce que je vais faire
- debug de l'enregistrement d'1 subscription
- mettre la date en français
- Ajouter durée plutôt que finishAt pour une inscription
-

## Ce qu'il me manque
-

# Sitemap
![pour validation au 31 mai](/captures/Sitemap.png)
