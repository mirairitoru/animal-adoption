import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

window.setRole = function(role) {

    console.log('setRole実行');
    console.log('role:', role);

    const roleInput = document.getElementById('role');
    if(!roleInput) return;

    roleInput.value = role;

    console.log('hidden input value:', roleInput.value);

    const userBtn = document.getElementById('btn-user');
    const orgBtn = document.getElementById('btn-org');

    const userFields = document.getElementById('user-fields');
    const orgFields = document.getElementById('org-fields');

    const form = document.getElementById('registerForm');

    userBtn.classList.remove('bg-green-700', 'text-white');
    orgBtn.classList.remove('bg-green-700', 'text-white');

    if (role === 'organization') {
        userFields.classList.add('hidden');
        orgFields.classList.remove('hidden');
        userBtn.classList.add('bg-gray-200');
        orgBtn.classList.add('bg-green-700', 'text-white');

        // userはdisabled = true無効
        userFields.querySelectorAll('input').forEach(el => {
            el.removeAttribute('name');
        });

        // organizationはdisabled = false有効
        orgFields.querySelectorAll('input').forEach(el => {
            el.setAttribute('name', el.id);
        });

    } else {
        orgFields.classList.add('hidden');
        userFields.classList.remove('hidden');
        orgBtn.classList.add('bg-gray-200');
        userBtn.classList.add('bg-green-700', 'text-white');
        // ここの箇所を編集する
        orgFields.querySelectorAll('input').forEach(el => {
            el.removeAttribute('name');
        });

        userFields.querySelectorAll('input').forEach(el => {
            el.setAttribute('name', el.id);
        });
    }
};

window.switchTab = function(role) {
    const userBtn = document.getElementById('login-btn-user');
    const orgBtn = document.getElementById('login-btn-org');

    const userForm = document.getElementById('userForm');
    const orgForm = document.getElementById('orgForm');

    userBtn.classList.remove('border-blue-600', 'text-blue-600');
    orgBtn.classList.remove('border-blue-600', 'text-blue-600');

    if(role === 'org') {
        orgBtn.classList.add('underline', 'text-blue-600');
        userBtn.classList.remove('underline', 'text-blue-600');

        userForm.classList.add('hidden');
        orgForm.classList.remove('hidden');
    } else {
        userBtn.classList.add('underline', 'text-blue-600');
        orgBtn.classList.remove('underline', 'text-blue-600');

        orgForm.classList.add('hidden');
        userForm.classList.remove('hidden');
    }
};

document.addEventListener('DOMContentLoaded', function() {
    const roleInput = document.getElementById('role');

    if(roleInput) {
        window.setRole(roleInput.value);
    }

    document.querySelectorAll('.open-modal').forEach(button => {
        button.addEventListener('click', (e) => {
            // 興味ありボタンをクリックしたらanimal_idが変わる
            const animalId = e.currentTarget.dataset.id;
            
            const title = document.getElementById('modal-title');
            if (title) {
                title.textContent = e.currentTarget.dataset.animal_name || '';
            }

            const form = document.getElementById('favorite-form');
            if(form) {
                form.action = `/favorites/${animalId}`;
            }

            const role = e.currentTarget.dataset.role;
            const isFavorited = e.currentTarget.dataset.favorited === 'true';
            const favoriteBtn = document.getElementById('modal-favorite-btn');

            // if(!favoriteBtn) return;

            // 保護団体は押せない
            if(role === 'organization' || role === 'org') {
                favoriteBtn.textContent = '興味あり(利用不可)';
                favoriteBtn.disabled = true;
                favoriteBtn.classList.remove('bg-blue-600', 'border-blue-600');
                favoriteBtn.classList.add('bg-gray-500','border-gray-500','cursor-not-allowed');
            } else if (isFavorited) {
                // 既に興味あり
                favoriteBtn.textContent = '興味あり済み';
                favoriteBtn.disabled = true;
                favoriteBtn.classList.remove('bg-blue-600', 'border-blue-600');
                favoriteBtn.classList.add('bg-red-500', 'border-red-500' ,'cursor-not-allowed');
            } else {
                favoriteBtn.textContent = '興味あり';
                favoriteBtn.disabled = false;
                favoriteBtn.classList.remove('bg-red-500', 'border-red-500' ,'cursor-not-allowed');
                favoriteBtn.classList.add('bg-blue-600', 'border-blue-600');
            }

            document.querySelectorAll('#modal [data-field]').forEach(el => {
                const key = el.dataset.field;
                el.textContent = e.currentTarget.dataset[key] || '';
            });

            // 性格のデータ
            const personality = e.currentTarget.dataset.personality || '';
            const container = document.querySelector('[data-field="personality"]');

            if(container) {
                container.innerHTML = '';

                if(personality) {
                    personality.split(',').map(p => p.trim()).forEach(p => {
                        const span = document.createElement('span');
                        span.textContent = p;
                        span.className = "border px-4 py-1 mr-4 inline-block border-black";
                        container.appendChild(span);
                    });
                }
            }

            const modal = document.getElementById('modal');
            if(modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
        });
    });

    const closeBtn = document.getElementById('close-modal');
    if(closeBtn) {
        closeBtn.addEventListener('click', function() {
            const modal = document.getElementById('modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        });
    }

    document.querySelectorAll('.open-user-modal').forEach(button => {
        button.addEventListener('click', (e) => {
            const modal = document.getElementById('user-detail-modal');

            modal.querySelectorAll('[data-field]').forEach(el => {
                const key = el.dataset.field;

                el.textContent = e.currentTarget.dataset[key] || '';
            });

            // モダール表示
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        });
    });

    // ユーザー閉じるボタン
    document.getElementById('user-close-modal')
    ?.addEventListener('click', () => {
        const modal = document.getElementById('user-detail-modal');

        modal.classList.add('hidden');
        modal.classList.remove('flex');
    });

    const matchModal = document.getElementById('match-modal');

    document.getElementById('close-match-modal')
    ?.addEventListener('click', () => {
        matchModal.classList.add('hidden');
        matchModal.classList.remove('flex');
    });

    document.getElementById('later-match-button')
    ?.addEventListener('click', () => {
        matchModal.classList.add('hidden');
        matchModal.classList.remove('flex');
    });

});