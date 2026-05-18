document.addEventListener("DOMContentLoaded", function () {

    const hamburger = document.getElementById("hamburger");
    const iconHamburger = document.getElementById("iconHamburger");
    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("overlay");

    if (hamburger && iconHamburger && sidebar && overlay) {

        hamburger.addEventListener("click", function () {

            sidebar.classList.toggle("terbuka");
            overlay.classList.toggle("aktif");
            hamburger.classList.toggle("aktif");

            if (sidebar.classList.contains("terbuka")) {

                iconHamburger.classList.remove("fa-bars");
                iconHamburger.classList.add("fa-xmark");

            } else {

                iconHamburger.classList.remove("fa-xmark");
                iconHamburger.classList.add("fa-bars");

            }

        });

        overlay.addEventListener("click", function () {

            sidebar.classList.remove("terbuka");
            overlay.classList.remove("aktif");
            hamburger.classList.remove("aktif");

            iconHamburger.classList.remove("fa-xmark");
            iconHamburger.classList.add("fa-bars");

        });

    }

    window.addEventListener("scroll", () => {

        const navbar = document.querySelector(".navigasi");

        if (!navbar) return;

        navbar.classList.toggle("scrolled", window.scrollY > 50);

    });

    const formLogin = document.getElementById("formLogin");

    if (formLogin) {

        formLogin.addEventListener("submit", function (e) {

            e.preventDefault();

            fetch("controllers/login.php", {
                method: "POST",
                body: new FormData(formLogin)
            })
            .then(res => res.json())
            .then(data => {

                let toast = document.createElement("div");

                toast.classList.add("toast");
                toast.innerText = data.message;

                document.body.appendChild(toast);

                if (data.status === "success") {

                    toast.classList.add("success");

                    setTimeout(() => {

                        if (data.role === "admin") {

                            window.location.href = "index.php?page=dashboard_admin";

                        } else if (data.role === "kader") {

                            window.location.href = "index.php?page=dashboard_kader";

                        } else {

                            window.location.href = "index.php?page=dashboard_pengguna";

                        }

                    }, 1000);

                } else {

                    toast.classList.add("error");

                    setTimeout(() => {
                        toast.remove();
                    }, 3000);

                }

            })
            .catch(() => {

                let toast = document.createElement("div");

                toast.classList.add("toast", "error");
                toast.innerText = "Login gagal!";

                document.body.appendChild(toast);

                setTimeout(() => {
                    toast.remove();
                }, 3000);

            });

        });

    }

    const registerForm = document.getElementById("formRegister");

    if (registerForm) {

        registerForm.addEventListener("submit", function (e) {

            e.preventDefault();

            fetch("controllers/register.php", {
                method: "POST",
                body: new FormData(registerForm)
            })
            .then(res => res.json())
            .then(data => {

                let toast = document.createElement("div");

                toast.classList.add("toast");
                toast.innerText = data.message;

                document.body.appendChild(toast);

                if (data.status === "success") {

                    toast.classList.add("success");

                    setTimeout(() => {
                        window.location.href = "index.php?page=login";
                    }, 1200);

                } else {

                    toast.classList.add("error");

                    setTimeout(() => {
                        toast.remove();
                    }, 3000);

                }

            })
            .catch(() => {

                let toast = document.createElement("div");

                toast.classList.add("toast", "error");
                toast.innerText = "Registrasi gagal!";

                document.body.appendChild(toast);

                setTimeout(() => {
                    toast.remove();
                }, 3000);

            });

        });

    }

    const namaAnak = document.getElementById("namaAnak");
    const previewNama = document.getElementById("previewNama");
    const previewInisial = document.getElementById("previewInisial");

    if (namaAnak && previewNama && previewInisial) {

        namaAnak.addEventListener("input", () => {

            let nama = namaAnak.value;

            previewNama.innerText = nama || "Nama Anak";

            if (nama.length > 0) {

                let inisial = nama
                    .split(" ")
                    .map(kata => kata[0])
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

        jenisKelamin.addEventListener("change", () => {

            previewJK.innerText = jenisKelamin.value || "—";

            if (jenisKelamin.value === "Perempuan") {
                previewAvatar.classList.add("perempuan");
            } else {
                previewAvatar.classList.remove("perempuan");
            }

        });

    }

    const golDar = document.getElementById("golonganDarah");
    const previewGolDar = document.getElementById("previewGolDar");

    if (golDar && previewGolDar) {

        golDar.addEventListener("change", () => {
            previewGolDar.innerText = golDar.value || "—";
        });

    }

    const fotoInput = document.getElementById("fotoAnak");
    const previewFoto = document.getElementById("previewFoto");
    const previewAvatarFix = document.getElementById("previewAvatar");

    if (fotoInput && previewFoto && previewAvatarFix) {

        fotoInput.addEventListener("change", function () {

            const file = this.files[0];

            if (file) {

                previewFoto.src = URL.createObjectURL(file);
                previewAvatarFix.classList.add("has-image");

            }

        });

    }

    const inputCari = document.getElementById('inputCari');

    if (inputCari) {

        inputCari.addEventListener('input', function () {

            const kata = this.value.toLowerCase();

            document.querySelectorAll('#tabelRiwayat tbody tr').forEach(function (baris) {

                const teks = baris.textContent.toLowerCase();

                baris.style.display = teks.includes(kata) ? '' : 'none';

            });

        });

    }

});

function confirmDelete(url) {

    const yakin = confirm("Yakin ingin menghapus data ini?");

    if (yakin) {
        window.location.href = url;
    }

}

const inputCari = document.getElementById("cariPeserta");

if (inputCari) {
    inputCari.addEventListener("input", function () {
        const keyword = this.value.toLowerCase();

        document.querySelectorAll("#tabelPeserta tbody tr").forEach(function (row) {
            row.style.display = row.textContent.toLowerCase().includes(keyword) ? "" : "none";
        });
    });
}

document.addEventListener("DOMContentLoaded", function () {

    const tabelUser = document.getElementById("tabelUser");

    if (!tabelUser) return;

    const rows = Array.from(
        tabelUser.querySelectorAll("tbody tr")
    );

    const pagination = document.getElementById("paginationUser");
    const downloadBtn = document.getElementById("downloadBtn");

    let currentPage = 1;
    const rowsPerPage = 5;

    function renderPagination(totalPages) {

        pagination.innerHTML = "";

        const prev = document.createElement("button");

        prev.innerHTML = `<i class="fa-solid fa-chevron-left"></i>`;

        prev.onclick = () => {
            showPage(currentPage - 1);
        };

        pagination.appendChild(prev);

        for (let i = 1; i <= totalPages; i++) {

            const btn = document.createElement("button");

            btn.innerText = i;

            if (i === currentPage) {
                btn.classList.add("aktif");
            }

            btn.onclick = () => {
                showPage(i);
            };

            pagination.appendChild(btn);

        }

        const next = document.createElement("button");

        next.innerHTML = `<i class="fa-solid fa-chevron-right"></i>`;

        next.onclick = () => {
            showPage(currentPage + 1);
        };

        pagination.appendChild(next);

    }

    function showPage(page) {

        const totalPages = Math.ceil(rows.length / rowsPerPage);

        if (page < 1) page = 1;
        if (page > totalPages) page = totalPages;

        currentPage = page;

        rows.forEach(row => {
            row.style.display = "none";
        });

        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;

        rows.slice(start, end).forEach(row => {
            row.style.display = "";
        });

        renderPagination(totalPages);

    }

    downloadBtn?.addEventListener("click", function () {

        let csv = "Nama,Email,Role,Status\n";

        rows.forEach(row => {

            const nama = row.querySelector(".user-info strong")?.innerText || "";
            const email = row.querySelector(".user-info p")?.innerText || "";
            const role = row.children[1]?.innerText.trim() || "";
            const status = row.children[2]?.innerText.trim() || "";

            csv += `"${nama}","${email}","${role}","${status}"\n`;

        });

        const blob = new Blob([csv], {
            type: "text/csv;charset=utf-8;"
        });

        const url = URL.createObjectURL(blob);

        const a = document.createElement("a");

        a.href = url;
        a.download = "data_pengguna.csv";

        document.body.appendChild(a);

        a.click();

        document.body.removeChild(a);

        URL.revokeObjectURL(url);

    });

    showPage(1);

});

document.addEventListener("DOMContentLoaded", function () {
    const tabBalita = document.getElementById("tabBalita");
    const tabIbu = document.getElementById("tabIbu");
    const dataBalita = document.getElementById("dataBalita");
    const dataIbu = document.getElementById("dataIbu");
    const cari = document.getElementById("cariPeserta");
    const filter = document.getElementById("filterPeserta");
    const pagination = document.getElementById("paginationPeserta");

    if (!tabBalita || !tabIbu || !dataBalita || !dataIbu) return;

    let activeTable = document.getElementById("tabelBalita");
    let rowsPerPage = 5;
    let currentPage = 1;
    let keyword = "";

    function getRows() {

    return Array.from(
        activeTable.querySelectorAll("tbody tr")
    ).filter(row => {

        const nama = row.querySelector("strong");

        if (!nama) return false;

        return nama.innerText
            .toLowerCase()
            .includes(keyword);

    });

}

    function sortRows(type) {
        const tbody = activeTable.querySelector("tbody");
        const rows = Array.from(tbody.querySelectorAll("tr"));

        rows.sort((a, b) => {
            const aName = a.querySelector("strong")?.innerText.toLowerCase() || "";
            const bName = b.querySelector("strong")?.innerText.toLowerCase() || "";

            if (type === "az") return aName.localeCompare(bName);
            if (type === "za") return bName.localeCompare(aName);
            return 0;
        });

        rows.forEach(row => tbody.appendChild(row));
    }

    function showPage(page) {
        const rows = getRows();
        const allRows = Array.from(activeTable.querySelectorAll("tbody tr"));
        const totalPages = Math.ceil(rows.length / rowsPerPage) || 1;

        currentPage = Math.max(1, Math.min(page, totalPages));

        allRows.forEach(row => row.style.display = "none");

        rows
            .slice((currentPage - 1) * rowsPerPage, currentPage * rowsPerPage)
            .forEach(row => row.style.display = "");

        pagination.innerHTML = "";

        const prev = document.createElement("button");
        prev.innerHTML = `<i class="fa-solid fa-chevron-left"></i>`;
        prev.onclick = () => showPage(currentPage - 1);
        pagination.appendChild(prev);

        for (let i = 1; i <= totalPages; i++) {
            const btn = document.createElement("button");
            btn.innerText = i;
            if (i === currentPage) btn.classList.add("aktif");
            btn.onclick = () => showPage(i);
            pagination.appendChild(btn);
        }

        const next = document.createElement("button");
        next.innerHTML = `<i class="fa-solid fa-chevron-right"></i>`;
        next.onclick = () => showPage(currentPage + 1);
        pagination.appendChild(next);
    }

    function switchTab(type) {
        keyword = "";
        if (cari) cari.value = "";
        if (filter) filter.value = "";

        if (type === "balita") {
            activeTable = document.getElementById("tabelBalita");
            dataBalita.classList.remove("hidden");
            dataIbu.classList.add("hidden");
            tabBalita.classList.add("aktif");
            tabIbu.classList.remove("aktif");
            cari.placeholder = "Cari nama balita...";
        } else {
            activeTable = document.getElementById("tabelIbu");
            dataIbu.classList.remove("hidden");
            dataBalita.classList.add("hidden");
            tabIbu.classList.add("aktif");
            tabBalita.classList.remove("aktif");
            cari.placeholder = "Cari nama ibu...";
        }

        showPage(1);
    }

    tabBalita.addEventListener("click", () => switchTab("balita"));
    tabIbu.addEventListener("click", () => switchTab("ibu"));

    cari?.addEventListener("input", function () {
        keyword = this.value.toLowerCase();
        showPage(1);
    });

    filter?.addEventListener("change", function () {
        sortRows(this.value);
        showPage(1);
    });

    showPage(1);
});