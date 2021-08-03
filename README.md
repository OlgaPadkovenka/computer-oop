# Travaux pratiques PHP - Composez votre PC gaming sur mesure (programmation orientée objet)

 ## Travail à réaliser

 ### 1. Écrire des modèles

 Écrire des modéles PHP sur la base de l'export de base de données fourni.

 ### 2. Refactoriser les vues

 Refactoriser le code existant pour fonctionner avec des objets au lieu de données brutes.

 ### 3. Dynamiser la page "composant"

 Dynamiser le contenu du fichier **component.php**. Lorsque l'on clique sur le nom d'un composant dans les menus déroulants de la barre de navigation, cette page doit afficher les informations du composant choisi.

 ### BONUS

 Trouver un moyen pour factoriser le code commun entre tous les modèles.


Écrire une classe SqlDatabaseHandler répondant aux spécifications suivantes:

Lorsque la classe est instanciée, elle crée et garde en mémoire une instance de PDO qui lui permettra d'envoyer des requêtes en base de données.Elle possède une collection de méthodes permettant de réaliser les opérations les plus courantes en base de données (récupérer tous les enregistrements d'une table, récupérer un enregistrement particulier en fonction de son identifiant, récupèrer des enregistrements correspondant à un critère particulier...).Ces méthodes peuvent être appelées de manière statique, de sorte qu'il est possible d'y accéder depuis n'importe où dans l'application.
Cette classe doit centraliser tous les appels à la base de données, et les modèles doivent passer par elle pour renvoyer des objets.
BONUS: trouver un moyen pour s'assurer que la classe SqlDatabaseHandler ait en toute circonstance une et une seule instance.