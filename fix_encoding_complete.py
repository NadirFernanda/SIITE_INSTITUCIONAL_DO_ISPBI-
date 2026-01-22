import os
import re

# Diretório base
base_dir = r'C:\Users\Administrator\Documents\SITE_ACTUALIZADO\VersaoDevNew\resources\views'

# Mapeamento completo de correções
replacements = {
    # Caracteres corrompidos
    'BIÃ‰': 'BIÉ',
    'BiÃ©': 'Bié',
    'POLITÃ‰CNICO': 'POLITÉCNICO',
    'COMUNITÃRIA': 'COMUNITÁRIA',
    'INVESTIGAÃ‡ÃƒO': 'INVESTIGAÇÃO',
    'EDUCAÃ‡ÃƒO': 'EDUCAÇÃO',
    'EXCELÃŠNCIA': 'EXCELÊNCIA',
    'EXTENSÃ': 'EXTENSÃ',
    'cientÃ­fico': 'científico',
    'tÃ©cnico': 'técnico',
    'GRADUAÃ‡ÃƒO': 'GRADUAÇÃO',
    'PÃ"S-GRADUAÃ‡ÃƒO': 'PÓS-GRADUAÇÃO',
    'Ã‡': 'Ç',
    'Ã¡': 'á',
    'Ã¢': 'â',
    'Ã£': 'ã',
    'Ã©': 'é',
    'Ãª': 'ê',
    'Ã­': 'í',
    'Ã³': 'ó',
    'Ãµ': 'õ',
    'Ãº': 'ú',
    'Ã§': 'ç',
    'Ã': 'Á',
    'Ã‚': 'Â',
    'Ãƒ': 'Ã',
    'Ã‰': 'É',
    'ÃŠ': 'Ê',
    'Ã': 'Í',
    'Ã"': 'Ó',
    'Ã•': 'Õ',
    'Ãš': 'Ú',
}

def fix_file(filepath):
    """Corrige um arquivo específico"""
    try:
        with open(filepath, 'r', encoding='utf-8', errors='ignore') as f:
            content = f.read()
        
        original_content = content
        
        # Aplicar todas as substituições
        for old, new in replacements.items():
            content = content.replace(old, new)
        
        # Só escrever se houver mudanças
        if content != original_content:
            with open(filepath, 'w', encoding='utf-8') as f:
                f.write(content)
            return True
    except Exception as e:
        print(f"Erro em {filepath}: {e}")
        return False
    
    return False

# Processar todos os arquivos .blade.php
fixed_count = 0
for root, dirs, files in os.walk(base_dir):
    for file in files:
        if file.endswith('.blade.php'):
            filepath = os.path.join(root, file)
            if fix_file(filepath):
                print(f"Fixed: {filepath}")
                fixed_count += 1

print(f"\nTotal de arquivos corrigidos: {fixed_count}")
