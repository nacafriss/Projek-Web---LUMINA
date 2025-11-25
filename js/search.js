document.getElementById("searchInput").addEventListener("keyup", function() {
                    let filter = this.value.toLowerCase();
                    let cards = document.querySelectorAll(".card-destination");
                    let noResult = document.getElementById("noResult");

                    let found = 0;

                    cards.forEach(card => {
                        let title = card.querySelector(".dest-title").innerText.toLowerCase();
                        let location = card.querySelector(".dest-location").innerText.toLowerCase();

                        if (title.includes(filter) || location.includes(filter)) {
                            found++;
                            card.style.display = "block";
                            card.style.opacity = "1";
                            card.style.transform = "scale(1)";
                        } else {
                            card.style.opacity = "0";
                            card.style.transform = "scale(.95)";
                            setTimeout(() => card.style.display = "none", 150);
                        }
                    });

                    // munculkan pesan kalau tidak ada hasil
                    if (found === 0) {
                        noResult.style.display = "block";
                    } else {
                        noResult.style.display = "none";
                    }
                });