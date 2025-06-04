<?= $this->extend('Admin/layout.php') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
    .form-container {
        max-width: 800px;
        margin: 0 auto;
        background-color: white;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .form-header {
        border-bottom: 2px solid #1f6186;
        padding-bottom: 15px;
        margin-bottom: 25px;
    }

    .form-header h2 {
        color: #1f6186;
        margin: 0;
        font-size: 24px;
        font-weight: 600;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #333;
        font-size: 14px;
    }

    .form-group .required {
        color: #e74c3c;
    }

    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e1e8ed;
        border-radius: 6px;
        font-size: 14px;
        transition: all 0.3s ease;
        box-sizing: border-box;
    }

    .form-control:focus {
        outline: none;
        border-color: #1f6186;
        box-shadow: 0 0 0 3px rgba(31, 97, 134, 0.1);
    }

    .form-control.is-invalid {
        border-color: #e74c3c;
    }

    .invalid-feedback {
        display: block;
        color: #e74c3c;
        font-size: 12px;
        margin-top: 5px;
    }

    .btn {
        font-size: 14px;
        padding: 12px 24px;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .btn-primary {
        background-color: #1f6186;
        color: white;
    }

    .btn-primary:hover {
        background-color: #154360;
        transform: translateY(-1px);
    }

    .btn-secondary {
        background-color: #6c757d;
        color: white;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
        color: white;
        text-decoration: none;
    }

    .form-actions {
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #e1e8ed;
        display: flex;
        gap: 15px;
        justify-content: flex-start;
    }

    .alert {
        padding: 15px 20px;
        margin-bottom: 20px;
        border-radius: 6px;
        font-size: 14px;
    }

    .alert-danger {
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
        color: #721c24;
    }

    .alert-success {
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        color: #155724;
    }

    @media (max-width: 768px) {
        .form-container {
            margin: 10px;
            padding: 20px;
        }
        
        .form-actions {
            flex-direction: column;
        }
        
        .btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="form-container">
    <div class="form-header">
        <h2><i class="fas fa-edit"></i> Edit Jabatan</h2>
    </div>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle"></i>
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if (isset($validation) && $validation->getErrors()) : ?>
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle"></i>
            <strong>Terjadi kesalahan:</strong>
            <ul style="margin: 10px 0 0 0; padding-left: 20px;">
                <?php foreach ($validation->getErrors() as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('Admin/Jabatan/update/' . $jabatan['id']) ?>" method="post" id="formJabatan">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="jabatan">
                Nama Jabatan <span class="required">*</span>
            </label>
            <input 
                type="text" 
                class="form-control <?= (isset($validation) && $validation->hasError('jabatan')) ? 'is-invalid' : '' ?>"
                id="jabatan" 
                name="jabatan" 
                value="<?= old('jabatan', $jabatan['jabatan']) ?>"
                placeholder="Masukkan nama jabatan"
                maxlength="100"
                required
            >
            <?php if (isset($validation) && $validation->hasError('jabatan')) : ?>
                <div class="invalid-feedback">
                    <?= $validation->getError('jabatan') ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary" id="btnSubmit">
                <i class="fas fa-save"></i>
                Update Data
            </button>
            <a href="<?= base_url('Admin/Jabatan') ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formJabatan');
    const submitBtn = document.getElementById('btnSubmit');
    
    // Form validation
    form.addEventListener('submit', function(e) {
        let isValid = true;
        const jabatan = document.getElementById('jabatan');
        
        // Check required field
        if (!jabatan.value.trim()) {
            isValid = false;
            jabatan.classList.add('is-invalid');
        } else {
            jabatan.classList.remove('is-invalid');
        }
        
        // Check minimum length
        if (jabatan.value.trim().length < 3) {
            alert('Nama jabatan minimal 3 karakter!');
            jabatan.classList.add('is-invalid');
            isValid = false;
        }
        
        if (!isValid) {
            e.preventDefault();
            alert('Mohon lengkapi semua field yang required!');
            return false;
        }
        
        // Show loading state
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengupdate...';
    });
    
    // Reset invalid state on input
    const inputs = form.querySelectorAll('input, select, textarea');
    inputs.forEach(function(input) {
        input.addEventListener('input', function() {
            this.classList.remove('is-invalid');
        });
    });
    
    // Auto capitalize first letter of jabatan
    const jabatanInput = document.getElementById('jabatan');
    jabatanInput.addEventListener('input', function() {
        let value = this.value;
        if (value.length > 0) {
            this.value = value.charAt(0).toUpperCase() + value.slice(1);
        }
    });
});
</script>

<?= $this->endSection() ?>