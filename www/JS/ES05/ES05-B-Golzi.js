console.log("User Agent:", navigator.userAgent);
console.log("Platform:", navigator.platform);
console.log("Preferred Language:", navigator.language);
console.log("Cookies Enabled:", navigator.cookieEnabled);
console.log("Online Status:", navigator.onLine);

if ('geolocation' in navigator) {
    navigator.geolocation.getCurrentPosition((position) => {
        console.log("Latitude:", position.coords.latitude);
        console.log("Longitude:", position.coords.longitude);
    }, (error) => {
        console.error("Geolocation error:", error.message);
    });
} else {
    console.log("Geolocation not supported");
}

