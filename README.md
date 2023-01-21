# build-resume

Build résume est une application qui permet aux personnes de générer leur curiculum vitae gratuitement et de le télécharger ou simplement l'herberger moyennant un abonnement premium.

## Backend

### Database

#### Users (front-end access)

- On a trois types d'utilisateurs:
    
    1. basicUser: (code = 0001)
        
        Peux:
        
        1. 1. Naviguer sur la page d'accueil 
        1. 2. Génerer un cv et le télécharger
        1. 3. Créer un compte

    2. blogerUser (code = 0010)

        2. 1. Naviguer sur la page d'accueil 
        2. 2. Poster un article, le modifier,le supprimer et le télécharger
        2. 3. Bloquer un autre user
        2. 4. se déconnecter 
        2. 5. se connecter 

    3. Admin (code = 0000)

        3. 1.  
        3. 2.  
        3. 3. 
        3. 4. 
