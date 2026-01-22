import os

# Cor de substituição: cinza claro institucional
CINZA_CLARO = '#F3F4F6'  # Tailwind gray-100

# Tons de lilás/roxo comuns
lilas_cores = [
    '#8B5CF6', '#7C3AED', '#A21CAF', '#9333EA', '#6D28D9', '#C026D3', '#A78BFA', '#D946EF', '#A855F7',
    '#9D174D', '#9F7AEA', '#7C3AED', '#8B5CF6', '#6D28D9', '#C084FC', '#E879F9', '#F472B6', '#F0ABFC', '#E0E7FF',
]

# Substituir todos os tons de lilás/roxo por cinza claro
substituicoes = {cor: CINZA_CLARO for cor in lilas_cores}

# Substituir gradientes roxo->azul por azul->cinza
substituicoes['from-[#8B5CF6] to-[#2563eb]'] = f'from-[{CINZA_CLARO}] to-[#2563eb]'
substituicoes['from-[#9333EA] to-[#2563eb]'] = f'from-[{CINZA_CLARO}] to-[#2563eb]'
substituicoes['from-[#A21CAF] to-[#2563eb]'] = f'from-[{CINZA_CLARO}] to-[#2563eb]'
substituicoes['from-[#A855F7] to-[#2563eb]'] = f'from-[{CINZA_CLARO}] to-[#2563eb]'

base_dir = r'C:\Users\Administrator\Documents\SITE_ACTUALIZADO\VersaoDevNew\resources\views'

for root, dirs, files in os.walk(base_dir):
    for file in files:
        if file.endswith('.blade.php'):
            path = os.path.join(root, file)
            with open(path, 'r', encoding='utf-8') as f:
                content = f.read()
            original = content
            for old, new in substituicoes.items():
                content = content.replace(old, new)
            if content != original:
                with open(path, 'w', encoding='utf-8') as f:
                    f.write(content)
                print(f'Lilas substituído por cinza: {file}')
print('Todos os tons de lilás/roxo foram substituídos por cinza claro institucional.')
