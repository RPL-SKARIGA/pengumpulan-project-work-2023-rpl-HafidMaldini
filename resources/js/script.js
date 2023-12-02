$(document).ready(function () {
    // Event handler untuk tombol "Edit"
    $('.edit-jawaban').click(function () {
        var listItem = $(this).parent();
        var jawabanText = listItem.find('p').text();

        // Mengambil ID komentar (misalnya, dari atribut data-komentar-id)
        var jawabanId = listItem.data('jawaban-id');
        
        // Menampilkan form edit dan mengisi dengan teks komentar saat ini
        $('#edited-jawaban').val(jawabanText);
        $('#edit-form').show();

        // Event handler untuk tombol "Simpan"
        $('#simpan-edit').click(function () {
            var updatedJawaban = $('#edited-jawaban').val();

            // Melakukan permintaan AJAX untuk mengirim data ke controller
            $.ajax({
                url: '/edit-jawaban',
                method: 'POST',
                data: {
                    jawaban_id: jawabanId,
                    updated_jawaban: updatedJawaban
                },
                success: function (response) {
                    // Perubahan berhasil disimpan, lakukan apa yang diperlukan
                    // (misalnya, tampilkan pesan sukses)
                },
                error: function (xhr, status, error) {
                    // Penanganan kesalahan jika perubahan gagal
                }
            });

            listItem.find('p').text(updatedJawaban);
            $('#edit-form').hide();
        });

        // Event handler untuk tombol "Batal"
        $('#batal-edit').click(function () {
            // Sembunyikan form edit tanpa menyimpan perubahan
            $('#edit-form').hide();
        });
    });
});

const alertPlaceholder = document.getElementById('liveAlertPlaceholder')
const appendAlert = (message, type) => {
  const wrapper = document.createElement('div')
  wrapper.innerHTML = [
    `<div class="alert alert-${type} alert-dismissible" role="alert">`,
    `   <div>${message}</div>`,
    '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
    '</div>'
  ].join('')

  alertPlaceholder.append(wrapper)
}

const alertTrigger = document.getElementById('liveAlertBtn')
if (alertTrigger) {
  alertTrigger.addEventListener('click', () => {
    appendAlert('Pertanyaan Berhasil Dibuat!', 'success')
  })
}
