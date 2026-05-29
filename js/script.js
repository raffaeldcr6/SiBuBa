document.addEventListener("DOMContentLoaded", function () {

    initLandingMenu();
    initSidebar();
    initNavbarScroll();
    initLoginForm();
    initRegisterForm();
    initPreviewAnak();
    initSearchTable();
    initPaginationUser();
    initStatusHamil();
    initPreviewFotoProfil();
    initDataPeserta();
    initDownloadCSV();

});


function initLandingMenu() {

    const toggleLanding = document.getElementById("toggleLanding");
    const navMenu = document.getElementById("navMenu");

    if (!toggleLanding || !navMenu) return;

    toggleLanding.addEventListener("click", function (event) {
        event.preventDefault();
        event.stopPropagation();

        navMenu.classList.toggle("aktif");
    });

    document.addEventListener("click", function (event) {
        const klikDiMenu = navMenu.contains(event.target);
        const klikDiTombol = toggleLanding.contains(event.target);

        if (!klikDiMenu && !klikDiTombol) {
            navMenu.classList.remove("aktif");
        }
    });

}



function initSidebar() {

    const hamburger = document.getElementById("hamburger");
    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("overlay");
    const navMenu = document.getElementById("navMenu");

    if (!hamburger) return;

    if (sidebar && overlay) {

        hamburger.addEventListener("click", function () {

            sidebar.classList.toggle("terbuka");
            overlay.classList.toggle("aktif");
            hamburger.classList.toggle("aktif");

        });

        overlay.addEventListener("click", function () {

            sidebar.classList.remove("terbuka");
            overlay.classList.remove("aktif");
            hamburger.classList.remove("aktif");

        });

    }

    if (navMenu) {

        hamburger.addEventListener("click", function () {

            navMenu.classList.toggle("aktif");

        });

    }

}



function initNavbarScroll() {

    const navbar = document.querySelector(".navbar-landing");

    if (!navbar) return;

    window.addEventListener("scroll", function () {

        navbar.classList.toggle(
            "scrolled",
            window.scrollY > 50
        );

    });

}



function initLoginForm() {

    const formLogin = document.getElementById("formLogin");

    if (!formLogin) return;

    formLogin.addEventListener("submit", async function (e) {

        e.preventDefault();

        try {

            const response = await fetch("controllers/login.php", {
                method: "POST",
                body: new FormData(formLogin)
            });

            const data = await response.json();

            showToast(data.message, data.status);

            if (data.status === "success") {

                setTimeout(function () {

                    if (data.role === "admin") {
                        window.location.href = "index.php?page=dashboard_admin";
                    } else if (data.role === "kader") {
                        window.location.href = "index.php?page=dashboard_kader";
                    } else {
                        window.location.href = "index.php?page=dashboard_pengguna";
                    }

                }, 1000);

            }

        } catch (error) {

            showToast("Login gagal!", "error");

        }

    });

}



function initRegisterForm() {

    const formRegister = document.getElementById("formRegister");

    if (!formRegister) return;

    formRegister.addEventListener("submit", async function (e) {

        e.preventDefault();

        try {

            const response = await fetch("controllers/register.php", {
                method: "POST",
                body: new FormData(formRegister)
            });

            const data = await response.json();

            showToast(data.message, data.status);

            if (data.status === "success") {

                setTimeout(function () {
                    window.location.href = "index.php?page=login";
                }, 1200);

            }

        } catch (error) {

            showToast("Registrasi gagal!", "error");

        }

    });

}



function showToast(message, type) {

    const toast = document.createElement("div");

    toast.className = "toast " + (type || "success");
    toast.innerText = message;

    document.body.appendChild(toast);

    setTimeout(function () {
        toast.remove();
    }, 3000);

}



function initPreviewAnak() {

    const namaAnak = document.getElementById("namaAnak");
    const previewNama = document.getElementById("previewNama");
    const previewInisial = document.getElementById("previewInisial");

    if (namaAnak && previewNama && previewInisial) {

        namaAnak.addEventListener("input", function () {

            const nama = namaAnak.value.trim();

            previewNama.innerText = nama || "Nama Anak";

            if (nama.length > 0) {

                const inisial = nama
                    .split(" ")
                    .map(function (kata) {
                        return kata[0];
                    })
                    .join("")
                    .substring(0, 2);

                previewInisial.innerText = inisial.toUpperCase();

            } else {

                previewInisial.innerText = "?";

            }

        });

    }

    const jenisKelamin = document.getElementById("jenisKelamin");
    const previewJK = document.getElementById("previewJK");
    const previewAvatar = document.getElementById("previewAvatar");

    if (jenisKelamin && previewJK && previewAvatar) {

        jenisKelamin.addEventListener("change", function () {

            previewJK.innerText = jenisKelamin.value || "—";

            if (jenisKelamin.value === "Perempuan") {
                previewAvatar.classList.add("perempuan");
            } else {
                previewAvatar.classList.remove("perempuan");
            }

        });

    }

    const golonganDarah = document.getElementById("golonganDarah");
    const previewGolDar = document.getElementById("previewGolDar");

    if (golonganDarah && previewGolDar) {

        golonganDarah.addEventListener("change", function () {
            previewGolDar.innerText = golonganDarah.value || "—";
        });

    }

    const fotoInput = document.getElementById("fotoAnak");
    const previewFoto = document.getElementById("previewFoto");

    if (fotoInput && previewFoto && previewAvatar) {

        fotoInput.addEventListener("change", function () {

            const file = this.files[0];

            if (!file) return;

            previewFoto.src = URL.createObjectURL(file);
            previewAvatar.classList.add("has-image");

        });

    }

}



function initSearchTable() {

    const inputCari = document.getElementById("inputCari");

    if (!inputCari) return;

    let timer;

    inputCari.addEventListener("input", function () {

        clearTimeout(timer);

        timer = setTimeout(function () {

            const form = inputCari.closest("form");

            if (form) {
                form.submit();
            }

        }, 400);

    });

}



function initPaginationUser() {

    const tabelUser = document.getElementById("tabelUser");
    const pagination = document.getElementById("paginationUser");

    if (!tabelUser || !pagination) return;

    const rows = Array.from(
        tabelUser.querySelectorAll("tbody tr")
    );

    let currentPage = 1;
    const rowsPerPage = 5;

    function showPage(page) {

        const totalPages = Math.ceil(rows.length / rowsPerPage) || 1;

        currentPage = Math.max(
            1,
            Math.min(page, totalPages)
        );

        rows.forEach(function (row) {
            row.style.display = "none";
        });

        const start = (currentPage - 1) * rowsPerPage;

        rows
            .slice(start, start + rowsPerPage)
            .forEach(function (row) {
                row.style.display = "";
            });

        renderPagination(totalPages);

    }

    function renderPagination(totalPages) {

        pagination.innerHTML = "";

        for (let i = 1; i <= totalPages; i++) {

            const btn = document.createElement("button");

            btn.innerText = i;

            if (i === currentPage) {
                btn.classList.add("aktif");
            }

            btn.addEventListener("click", function () {
                showPage(i);
            });

            pagination.appendChild(btn);

        }

    }

    showPage(1);

}



function initStatusHamil() {

    const statusHamil = document.getElementById("statusHamil");
    const usiaGroup = document.getElementById("usiaKehamilanGroup");

    if (!statusHamil || !usiaGroup) return;

    function toggleUsia() {

        if (statusHamil.value === "ya") {
            usiaGroup.style.display = "flex";
        } else {
            usiaGroup.style.display = "none";
        }

    }

    statusHamil.addEventListener("change", toggleUsia);

    toggleUsia();

}



function initPreviewFotoProfil() {

    const inputFoto = document.getElementById("inputFotoProfil");
    const previewFoto = document.getElementById("previewFotoProfil");
    const previewInisial = document.getElementById("previewInisialProfil");

    if (!inputFoto || !previewFoto) return;

    inputFoto.addEventListener("change", function () {

        const file = this.files[0];

        if (!file) return;

        const reader = new FileReader();

        reader.onload = function (e) {

            previewFoto.src = e.target.result;
            previewFoto.style.display = "block";

            if (previewInisial) {
                previewInisial.style.display = "none";
            }

        };

        reader.readAsDataURL(file);

    });

}



function confirmDelete(url) {

    const yakin = confirm("Yakin ingin menghapus data ini?");

    if (yakin) {
        window.location.href = url;
    }

}



function initDataPeserta() {

    const tabBalita      = document.getElementById("tabBalita");
    const tabIbu         = document.getElementById("tabIbu");
    const panelBalita    = document.getElementById("panelBalita");
    const panelIbu       = document.getElementById("panelIbu");
    const inputCari      = document.getElementById("inputCariPeserta");
    const filterUrut     = document.getElementById("filterUrutPeserta");
    const infoPeserta    = document.getElementById("infoPeserta");

    
    if (!tabBalita || !tabIbu) return;

    
    tabBalita.addEventListener("click", function () {
        tabBalita.classList.add("aktif");
        tabIbu.classList.remove("aktif");
        panelBalita.classList.remove("hidden");
        panelIbu.classList.add("hidden");
        terapkanFilter();
    });

    tabIbu.addEventListener("click", function () {
        tabIbu.classList.add("aktif");
        tabBalita.classList.remove("aktif");
        panelIbu.classList.remove("hidden");
        panelBalita.classList.add("hidden");
        terapkanFilter();
    });

    
    if (inputCari)  inputCari.addEventListener("input",  terapkanFilter);
    if (filterUrut) filterUrut.addEventListener("change", terapkanFilter);

    function terapkanFilter() {

        const kata = inputCari ? inputCari.value.toLowerCase().trim() : "";
        const urut = filterUrut ? filterUrut.value : "";

        
        const tabelAktif = panelBalita.classList.contains("hidden")
            ? document.getElementById("tabelIbu")
            : document.getElementById("tabelBalita");

        if (!tabelAktif) return;

        const tbody = tabelAktif.querySelector("tbody");
        const baris = Array.from(tbody.querySelectorAll("tr"));

        
        baris.forEach(function (tr) {
            const teks = tr.innerText.toLowerCase();
            tr.style.display = teks.includes(kata) ? "" : "none";
        });

        
        if (urut === "az" || urut === "za") {

            const terlihat = baris.filter(function (tr) {
                return tr.style.display !== "none";
            });

            terlihat.sort(function (a, b) {
                const na = a.cells[0] ? a.cells[0].innerText.trim() : "";
                const nb = b.cells[0] ? b.cells[0].innerText.trim() : "";
                return urut === "az" ? na.localeCompare(nb) : nb.localeCompare(na);
            });

            terlihat.forEach(function (tr) {
                tbody.appendChild(tr);
            });

        }

        
        if (infoPeserta) {
            const tampil = baris.filter(function (tr) {
                return tr.style.display !== "none";
            }).length;

            infoPeserta.textContent = "Menampilkan " + tampil + " data";
        }

    }

    
    terapkanFilter();

}



function initDownloadCSV() {

    const downloadBtn = document.getElementById("downloadBtn");
    const table = document.getElementById("tabelUser");

    if (!downloadBtn || !table) return;

    downloadBtn.addEventListener("click", function () {

        let csv = [];
        const rows = table.querySelectorAll("tr");

        for (let i = 0; i < rows.length; i++) {

            const row = [];
            const cols = rows[i].querySelectorAll("td, th");

            for (let j = 0; j < cols.length - 1; j++) { // Skip the last column (Aksi)
                let data = cols[j].innerText.replace(/(\r\n|\n|\r)/gm, " ").trim();
                data = data.replace(/"/g, '""');
                row.push('"' + data + '"');
            }

            csv.push(row.join(","));

        }

        const csvContent = "data:text/csv;charset=utf-8,\uFEFF" + csv.join("\n");
        const encodedUri = encodeURI(csvContent);
        const link = document.createElement("a");

        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "data_pengguna.csv");

        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);

    });

}



document.querySelectorAll('.tab-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
        
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('aktif'));
        document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('aktif'));

        
        btn.classList.add('aktif');
        document.getElementById(btn.dataset.tab).classList.add('aktif');
    });
});
