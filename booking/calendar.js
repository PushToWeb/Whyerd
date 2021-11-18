function startbook(id) {
    var params = new URLSearchParams();
    params.append("id", id);
    location.href = "booking.html?" + params.toString();
}