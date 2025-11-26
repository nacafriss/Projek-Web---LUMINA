document.getElementById("contactForm").addEventListener("submit", function(event) {
    event.preventDefault(); 

    let formData = new FormData(this);

    fetch("https://api.web3forms.com/submit", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            alert("Message sent!");
            this.reset();
            window.location.href = "index.php#contact";
        } else {
            alert("Submission failed. Please try again.");
        }
    })
    .catch(error => console.error("Error:", error));
});
