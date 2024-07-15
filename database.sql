CREATE DATABASE BOOKS;
USE BOOKS;
drop database books;

CREATE TABLE NGUOI_DUNG(
	 ND_ID INT AUTO_INCREMENT PRIMARY KEY,
	 ND_MatKhau VARCHAR(255),
	 ND_HoTen CHAR(30),
	 ND_GioiTinh enum('Nam','Nữ'),
	 ND_NgayTao DATE,
	 ND_Email varchar(50) check (`ND_Email` regexp "^[a-zA-Z0-9][a-zA-Z0-9.!#$%&'*+-/=?^_`{|}~]*?[a-zA-Z0-9._-]?@[a-zA-Z0-9][a-zA-Z0-9._-]*?[a-zA-Z0-9]?\\.[a-zA-Z]{2,63}$"),
	 ND_SoDienThoai char(10) check(regexp_replace(ND_SoDienThoai,'[^0-9]', '')),
	 ND_DiaChi VARCHAR(50),
     ND_VaiTro CHAR(20)
     );
drop table nguoi_dung;
select* from nguoi_dung;
 CREATE TABLE LOAI_SACH(
	LS_ID INT AUTO_INCREMENT PRIMARY KEY,
	LS_Ten CHAR(30),
	LS_MoTa VARCHAR(50)
);
drop table loai_sach;
select * from loai_sach;
insert into LOAI_SACH (LS_Ten,LS_MoTa) value('Khoa học','Hay');
select * from SACH join LOAI_SACH on sach.ls_id=loai_sach.ls_id where Ls_ten = 'Ki nang song';
CREATE TABLE SACH(
	SACH_ID INT AUTO_INCREMENT PRIMARY KEY,
	SACH_Ten CHAR(30),
    SACH_Anh longblob,
    SACH_TacGia CHAR(30),
	SACH_NgonNgu CHAR(30),
	SACH_SoLuong INT,
	SACH_LuotMua FLOAT,
	SACH_GiaNhap INT,
	SACH_GiaBan FLOAT(6,3),
	SACH_GiaKhuyenMai INT,
	SACH_NhaXuatBan CHAR(30),
	SACH_NgayXuatBan DATE,
	SACH_NgayTao DATE,
	SACH_NgayCapNhat DATE,
	SACH_Sotrang INT,
	SACH_MoTa VARCHAR(300),
	LS_ID INT,
	FOREIGN KEY (LS_ID) REFERENCES LOAI_SACH(LS_ID)
);
select * from sach;
ALTER TABLE sach
MODIFY COLUMN SACH_GiaKhuyenMai Float(6,3);
drop table sach;
update  sach set SACH_GiaKhuyenMai=95.000 where sach_id=11;
delete from sach where sach_id=3;
insert into sach(sach_ten,sach_anh,sach_tacgia,sach_ngonngu,sach_soluong,sach_luotmua,sach_gianhap,sach_giaban,sach_giakhuyenmai,sach_nhaxuatban,sach_ngayxuatban,sach_sotrang,sach_mota,ls_id)value('Bí mât tư duy triệu phú','./images/bi-mat-tu-duy-trieu-phu.jpg','	T Harv Eker','Tiếng việt',20,102,'80.000','108.000','73.000','Nhã Nam','2020-05-09',310,'rong cuốn sách này T. Harv Eker sẽ tiết lộ những bí mật tại sao một số người lại đạt được những thành công vượt bậc, được số phận ban cho cuộc sống sung túc, giàu có',2);
insert into sach(sach_ten,sach_anh,sach_tacgia,sach_ngonngu,sach_nhaxuatban,sach_giaban,sach_sotrang,sach_mota,ls_id)value('Đọc vị bất kì ai','./images/doc-vi-bat-ky-ai.jpg"','TS David J Lieberman','Tiếng việt','Lao Động','60.000',223,'Bạn băn khoăn không biết người ngồi đối diện đang nghĩ gì? Họ có đang nói dối bạn không? Đối tác đang ngồi đối diện với bạn trên bàn đàm phán đang nghĩ gì và nói gì tiếp theo? ĐỌC người khác là một trong những công cụ quan trọng, có giá trị nhất, giúp ích cho bạn trong mọi khía cạnh của cuộc sống',4);
insert into sach(sach_ten,sach_anh,sach_tacgia,sach_ngonngu,sach_nhaxuatban,sach_giaban,sach_sotrang,sach_mota,ls_id)value('Tiếng thét câm lặng','./images/tieng-thet-cam-lang.jpg"','Oe Kenzaburo','Tiếng Việt','Văn Học','250.000',504,'Trong khi những người đã từng vượt qua địa ngục của riêng họ tồn tại rất vững trãi, thì tôi sẽ phải tiếp tục thì tôi sẽ phải sống những ngày tháng mơ hồ bất định và u ám, không có chí hướng cụ thể gì ư? Không có cách nào để tôi trút bỏ được nó và rút lui vào bóng tối thư thái hơn sao?',3);
select* from sach;
update sach set ls_id=1 where sach_id=2;

 

-- CREATE TABLE DON_HANG (
-- 	DH_ID INT AUTO_INCREMENT PRIMARY KEY,
-- 	ND_ID INT,
-- 	SACH_ID INT,
-- 	DH_NgayLap DATE,
-- 	DH_TongTien FLOAT,
--     FOREIGN KEY (ND_ID) REFERENCES NGUOI_DUNG(ND_ID),
--     FOREIGN KEY (SACH_ID) REFERENCES SACH(SACH_ID)
-- );

CREATE TABLE CHI_TIET_DON_HANG(
	CTDH_ID INT AUTO_INCREMENT PRIMARY KEY,
    ND_ID INT,
	SACH_ID INT,
	CTDH_SoLuong INT,
	CTDH_DonGia FLOAT(6,3),
    CTDH_ThanhTien FLOAT(6,3),
    CTDH_NgayLap DATE,
    FOREIGN KEY (SACH_ID) REFERENCES SACH(SACH_ID),
    FOREIGN KEY (ND_ID) REFERENCES NGUOI_DUNG(ND_ID)
);
select *from chi_tiet_don_hang;
drop table chi_tiet_don_hang;
