    document.addEventListener('DOMContentLoaded', function() {
        const uploadBox = document.getElementById('uploadBox');
        const fileInput = document.getElementById('file_bukti_kerusakan');
        const uploadPreview = document.getElementById('uploadPreview');
        const previewImage = document.getElementById('previewImage');
        const previewIcon = document.getElementById('previewIcon');
        const previewFileName = document.getElementById('previewFileName');
        const previewFileSize = document.getElementById('previewFileSize');
        const removeFileBtn = document.getElementById('removeFileBtn');
        const fileError = document.getElementById('fileError');
        const form = document.getElementById('uploadForm');
        
        // Handle toast notification
        const toast = document.getElementById('toast');
        if (toast) {
            // Show toast with animation
            setTimeout(() => {
                toast.classList.add('show');
            }, 100);
            
            // Close toast when close button is clicked
            const closeBtn = toast.querySelector('.toast-close');
            if (closeBtn) {
                closeBtn.addEventListener('click', () => {
                    toast.classList.remove('show');
                });
            }
            
            // Auto-hide after 5 seconds
            setTimeout(() => {
                toast.classList.remove('show');
            }, 5000);
        }
        
        // Handle drag and drop events
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            uploadBox.addEventListener(eventName, preventDefaults, false);
        });
        
        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }
        
        ['dragenter', 'dragover'].forEach(eventName => {
            uploadBox.addEventListener(eventName, highlight, false);
        });
        
        ['dragleave', 'drop'].forEach(eventName => {
            uploadBox.addEventListener(eventName, unhighlight, false);
        });
        
        function highlight() {
            uploadBox.classList.add('dragover');
        }
        
        function unhighlight() {
            uploadBox.classList.remove('dragover');
        }
        
        // Handle dropped files
        uploadBox.addEventListener('drop', handleDrop, false);
        
        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            
            if (files.length) {
                fileInput.files = files;
                handleFiles(files);
            }
        }
        
        // Handle file selection via click
        fileInput.addEventListener('change', function() {
            handleFiles(this.files);
        });
        
        // Handle click on upload box
        uploadBox.addEventListener('click', function() {
            fileInput.click();
        });
        
        // Handle file processing
        function handleFiles(files) {
            const file = files[0];
            
            // Reset error message
            fileError.style.display = 'none';
            fileError.textContent = '';
            
            // Validate file
            if (!file) return;
            
            const validTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/avif'];
            const maxSize = 2 * 1024 * 1024; // 2MB
            
            if (!validTypes.includes(file.type)) {
                fileError.textContent = 'Format file tidak didukung. Harap unggah file JPG, PNG, WEBP, atau AVIF.';
                fileError.style.display = 'block';
                return;
            }
            
            if (file.size > maxSize) {
                fileError.textContent = 'Ukuran file terlalu besar. Maksimal 2MB.';
                fileError.style.display = 'block';
                return;
            }
            
            // Display file info
            previewFileName.textContent = file.name;
            previewFileSize.textContent = formatFileSize(file.size);
            
            // Display preview if it's an image
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'block';
                    previewIcon.style.display = 'none';
                }
                
                reader.readAsDataURL(file);
            } else {
                previewImage.style.display = 'none';
                previewIcon.style.display = 'block';
            }
            
            // Show preview container
            uploadPreview.style.display = 'block';
        }
        
        // Remove file handler
        removeFileBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            resetFileInput();
        });
        
        function resetFileInput() {
            fileInput.value = '';
            uploadPreview.style.display = 'none';
            previewImage.style.display = 'none';
            previewIcon.style.display = 'block';
            fileError.style.display = 'none';
        }
        
        // Format file size
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }
        
        // Form validation
        form.addEventListener('submit', function(e) {
            let isValid = true;
            
            // Check required fields
            const requiredFields = form.querySelectorAll('[required]');
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.style.borderColor = '#dc3545';
                    
                    // Add error message
                    let errorDiv = field.parentNode.querySelector('.field-error');
                    if (!errorDiv) {
                        errorDiv = document.createElement('div');
                        errorDiv.className = 'field-error';
                        errorDiv.style.color = '#dc3545';
                        errorDiv.style.fontSize = '14px';
                        errorDiv.style.marginTop = '5px';
                        field.parentNode.appendChild(errorDiv);
                    }
                    errorDiv.textContent = 'Field ini wajib diisi';
                } else {
                    field.style.borderColor = '#d1d5db';
                    
                    // Remove error message
                    const errorDiv = field.parentNode.querySelector('.field-error');
                    if (errorDiv) {
                        errorDiv.remove();
                    }
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                alert('Harap isi semua field yang wajib diisi.');
            }
        });
    });
