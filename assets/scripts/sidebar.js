$(function() {
    let newProjectModal = document.getElementById('newProjectModal');

    const projectsList = document.querySelector(".list-group");
    const projectsSection = document.querySelector(".projects-section"); 

    fetch("/api/projects")
    .then(response => response.json())
    .then(data => {
        // if (data.length === 0) {
        //     projectsSection.style.display = "none";
        // } else {
        //     console.log(data);
        //     data.forEach(project => {
        //         const li = document.createElement("li");
        //         li.className = "list-group-item d-flex justify-content-between align-items-center";
        //         li.innerHTML = `
        //             <span>${project.name}</span>
        //             <a href="/project/${project.id}" class="btn btn-sm btn-outline-secondary">View</a>
        //         `;
        //         projectsList.appendChild(li);
        //     });
        // }
    });
});