import os
import codecs

base_dir = r'C:\Users\Administrator\Documents\SITE_ACTUALIZADO\VersaoDevNew\resources\views'

# Mapeamentos de correção - todos os padrões encontrados
corrections = {
    # Padrões principais
    'EDUCAÇÍO': 'EDUCAÇÃO',
    'INVESTIGAÇÍO': 'INVESTIGAÇÃO',
    'INOVAÇÍO': 'INOVAÇÃO',
    'EXTENSÍO': 'EXTENSÃO',
    'COMUNITÍRIA': 'COMUNITÁRIA',
    'GRADUAÇÍO': 'GRADUAÇÃO',
    'POLITÚCNICO': 'POLITÉCNICO',
    
    # Todas as variantes de Bié
    'BIÚ': 'BIÉ',
    'BiÚ': 'Bié',
    'BIÃ‰': 'BIÉ',
    'BiÃ©': 'Bié',
    
    # Letras individuais corrompidas
    'ÇÃƒO': 'ÇÃO',
    'ÇÃŠO': 'ÇÃO',
    'ÇÍO': 'ÇÃO',
    'ÃŠ': 'Ê',
    'Ãš': 'Ú',
    'Ã‰': 'É',
    'Ã': 'Í',
    'Ãƒ': 'Ã',
    'Ã‡': 'Ç',
    
    # Palavras completas que devem estar corretas
    'EXCELÃŠNCIA': 'EXCELÊNCIA',
    'EXCELÚNCIA': 'EXCELÊNCIA',
}

def fix_file_encoding(filepath):
    """Corrige encoding de um arquivo"""
    try:
        # Tentar ler com UTF-8
        with open(filepath, 'r', encoding='utf-8', errors='replace') as f:
            content = f.read()
        
        original = content
        
        # Aplicar todas as correções
        for wrong, correct in corrections.items():
            if wrong in content:
                content = content.replace(wrong, correct)
                print(f"  Corrigido '{wrong}' -> '{correct}' em {os.path.basename(filepath)}")
        
        # Escrever de volta se houver mudanças
        if content != original:
            with open(filepath, 'w', encoding='utf-8', newline='\n') as f:
                f.write(content)
            return True
            
    except Exception as e:
        print(f"Erro em {filepath}: {e}")
    
    return False

# Processar recursivamente
total_fixed = 0
for root, dirs, files in os.walk(base_dir):
    for filename in files:
        if filename.endswith('.blade.php'):
            filepath = os.path.join(root, filename)
            if fix_file_encoding(filepath):
                print(f"✓ {filepath}")
                total_fixed += 1

print(f"\n{total_fixed} arquivos corrigidos")
