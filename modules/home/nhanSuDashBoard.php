<?php
$info = [
    'title' => 'DashBoard'
];
if (isLogin() == false) {
    header('Location: ?module=auth&action=login');
}
layouts('headerNS', $info);
//check login
$listEmp = getRow('select * from nhanvien');
?>
<div class="my-content">
    <div class="my-body fixed-top container p-3">
        <div class="banner"><img src="templates/img/banner.png" alt="" class="omg-banner"></div>
        <div class="d-flex">
            <div class="section section-1">
                <h2>Giới thiệu về công ty 10pm</h2>
                <p>Công ty 10pm là doanh nghiệp chuyên sản xuất và kinh doanh các thiết bị viễn thông phục vụ cho ngành công nghệ thông tin. Công ty được thành lập từ năm 2020.</p>
            </div>
            <div class="section section-2">
                <h2>Quá trình phát triển</h2>
                <p>Ban đầu, công ty chỉ có một xưởng sản xuất nhỏ với vài công nhân.</p>
                <p>Sau đó, công ty đã nhanh chóng mở rộng và hiện đại hóa.</p>
                <p>Công ty đã xây dựng được một nhà máy sản xuất với dây chuyền công nghệ tiên tiến và máy móc hiện đại.</p>

            </div>
            <div class="section section-3">
                <h2>Quy mô và nhân sự</h2>
                <p>Quy mô sản xuất và kinh doanh của công ty đã được mở rộng đáng kể.</p>
                <p>Hiện tại, công ty có khoảng 100 nhân viên, bao gồm công nhân và nhân viên văn phòng.</p>
                <p>Điều này phản ánh sự phát triển nhanh chóng của công ty và nhu cầu lao động ngày càng tăng.</p>
            </div>
            <div class="section section-4">
                <h2>Thế mạnh và định hướng phát triển</h2>

                <p>Với những cải tiến và đầu tư mạnh mẽ vào công nghệ, cơ sở vật chất và nhân lực, công ty 10pm đang khẳng định vị thế của mình trong ngành công nghiệp viễn thông và công nghệ thông tin.</p>
                <p>Công ty hy vọng sẽ tiếp tục phát triển và mở rộng thị trường trong những năm tới.</p>

            </div>
        </div>
        <!-- <img src="templates/img/logo.png" alt="" class="my-hero mt-4"> -->


        <div class="fixed-top my-footer-tb d-flex justify-content-center align-items-center">
            <i class="fa-regular fa-copyright" style="color: #000;"></i>
            <p class="copy-right">Copyright 2024 by Tenpm</p>
        </div>
    </div>

</div>
</body>
<?php
layouts('footer', $info);
