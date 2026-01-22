import os

# Azul mais claro institucional
AZUL_CLARO = '#2563eb'  # Tailwind blue-600
AZUL_CLARO2 = '#3B82F6' # Tailwind blue-500

# Substituições de azul escuro para azul claro
substituicoes = {
    '#1A365D': AZUL_CLARO,
    '#2C4A5E': AZUL_CLARO,
    '#3B5998': AZUL_CLARO2,
    '#0E8F81': AZUL_CLARO,
    '#3B5998': AZUL_CLARO2,
    'from-[#1A365D] to-[#2563eb]': f'from-[{AZUL_CLARO}] to-[{AZUL_CLARO2}]',
    'from-[#2C4A5E] to-[#2563eb]': f'from-[{AZUL_CLARO}] to-[{AZUL_CLARO2}]',
    'from-[#0E8F81] to-[#2563eb]': f'from-[{AZUL_CLARO}] to-[{AZUL_CLARO2}]',
    'from-[#2C4A5E] to-[#3B5998]': f'from-[{AZUL_CLARO}] to-[{AZUL_CLARO2}]',
    'from-[#1A365D] to-[#3B82F6]': f'from-[{AZUL_CLARO}] to-[{AZUL_CLARO2}]',
    'from-[#2C4A5E] to-[#3B82F6]': f'from-[{AZUL_CLARO}] to-[{AZUL_CLARO2}]',
    'border-[#1A365D]': f'border-[{AZUL_CLARO}]',
    'border-[#2C4A5E]': f'border-[{AZUL_CLARO}]',
    'border-[#0E8F81]': f'border-[{AZUL_CLARO}]',
    'text-[#2C4A5E]': f'text-[{AZUL_CLARO}]',
    'text-[#1A365D]': f'text-[{AZUL_CLARO}]',
    'text-[#0E8F81]': f'text-[{AZUL_CLARO}]',
}

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
                print(f'Azul ajustado: {file}')
print('Azul claro aplicado em todo o site.')
