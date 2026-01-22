import os

base_dir = r'C:\Users\Administrator\Documents\SITE_ACTUALIZADO\VersaoDevNew\resources\views'

# Dicionário de correções
fixes = {
    'INVESTIGAÇÍO': 'INVESTIGAÇÃO',
    'INOVAÇÍO': 'INOVAÇÃO',
    'EDUCAÇÍO': 'EDUCAÇÃO',
    'EXTENSÍO': 'EXTENSÃO',
    'GRADUAÇÍO': 'GRADUAÇÃO',
    'COMUNITÍRIA': 'COMUNITÁRIA',
    'POLITÚCNICO': 'POLITÉCNICO',
    'BIÚ': 'BIÉ',
    'BiÚ': 'Bié',
}

total = 0
for root, dirs, files in os.walk(base_dir):
    for filename in files:
        if filename.endswith('.blade.php'):
            filepath = os.path.join(root, filename)
            
            with open(filepath, 'r', encoding='utf-8') as f:
                content = f.read()
            
            original = content
            for wrong, correct in fixes.items():
                content = content.replace(wrong, correct)
            
            if content != original:
                with open(filepath, 'w', encoding='utf-8') as f:
                    f.write(content)
                print(f"✓ {filename}")
                total += 1

print(f"\nTotal: {total} arquivos corrigidos")
