    document.addEventListener('DOMContentLoaded', function () {
    var addToCartButtons = document.querySelectorAll('[id^="addToCartBtn_"]');

    addToCartButtons.forEach(function (button) {
    button.addEventListener('click', function () {
    var productId = button.id.split('_')[1]; // Récupère l'ID du produit depuis l'ID du bouton

    // Faites une requête Ajax pour ajouter le produit au panier
    // Vous pouvez utiliser XMLHttpRequest, Fetch API ou une bibliothèque comme Axios
    // Exemple avec Fetch API :
    fetch('/ajouter-au-panier/' + productId, {
    method: 'POST',
    headers: {
    'Content-Type': 'application/json',
},
    // Vous pouvez également envoyer des données supplémentaires ici si nécessaire
})
    .then(response => response.json())
    .then(data => {
    // Mettez à jour l'interface utilisateur pour refléter l'ajout au panier si nécessaire
    console.log('Produit ajouté au panier :', data);
})
    .catch(error => {
    console.error('Erreur lors de l\'ajout au panier :', error);
});
});
});
});
