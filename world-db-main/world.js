document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('lookup').addEventListener('click', function () {
        var countryInput = document.getElementById('country');
        var country = countryInput.value;
        var xhr = new XMLHttpRequest();
        if (country.trim() !== '') {
            xhr.open('GET', 'world.php?country=' + encodeURIComponent(country), true);
        } else {
            xhr.open('GET', 'world.php', true);
        }
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById('result').innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    });

    document.getElementById('lookupCities').addEventListener('click', function () {

        var countryInput = document.getElementById('country');
        var country = countryInput.value;
        var xhr = new XMLHttpRequest();
        if (country.trim() !== '') {
            xhr.open('GET', 'world.php?country=' + encodeURIComponent(country) + '&lookup=cities', true);
        }
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById('result').innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    });
});

