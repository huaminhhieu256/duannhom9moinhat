</div>

<script>
    //lấy button
    search = document.getElementById('search');
    keyword = document.getElementById('keyword')
    //viết sự kiện click cho nút search
    search.addEventListener('click', function() {
        searchProduct();
    })

    keyword.addEventListener('keydown', function(e) {
        if (e.key == 'Enter') {
            searchProduct();
            e.preventDefault()
        }
    })
    //hàm seach()
    function searchProduct() {
        window.location = "<?= ROOT_URL ?>" + "?ctl=search&keyword=" + keyword.value;
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<footer style="background-color: #dc3545; color: white; padding: 20px 0;">
    <div class="footer-content wrapper" style="max-width: 1200px; margin: auto; display: flex; justify-content: space-between; flex-wrap: wrap; gap: 20px;">
        <div class="footer-section contact-info" style="flex: 1; min-width: 250px;">
            <h4 style="margin-bottom: 10px; font-size: 18px; text-transform: uppercase;">Kết nối với chúng tôi</h4>
            <p>Facebook: Minh Hiếu</p>
            <p>Instagram: baanhemshop</p>
            <p>Hotline: <a href="tel:18008386" style="color: #ffc107;">18008386</a></p>
        </div>
        <div class="footer-section business-info" style="flex: 1; min-width: 250px;">
            <p>Địa chỉ: 191 Phạm Văn Đồng, Quận Bắc Từ Liêm, Hà Nội</p>
            <p>Giờ hoạt động: 8:00 - 21:00</p>
            <p>© 2024 quavatonline</p>
        </div>
    </div>
</footer>


</body>

</html>