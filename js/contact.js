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
                  window.location.href = "thanks.html"; 
              } else {
                  alert("Submission failed. Please try again.");
              }
          })
          .catch(error => console.error("Error:", error));
      });